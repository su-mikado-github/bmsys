/**
 * セッション管理
 */
export class Session {
    #userName = "wsi.session.user";

    #tokenName = "wsi.session.token";

    #messageName = "wsi.session.message";

    isToken() {
        return !!localStorage.getItem(this.#tokenName);
    }
    clearToken() {
        localStorage.removeItem(this.#tokenName);
    }
    get token() {
        return localStorage.getItem(this.#tokenName);
    }
    set token(value) {
        localStorage.setItem(this.#tokenName, value ?? null);
    }

    isUser() {
        return !!localStorage.getItem(this.#userName);
    }
    clearUser() {
        localStorage.removeItem(this.#userName);
    }
    get user() {
        const user = localStorage.getItem(this.#userName);
        return !user ? null : JSON.parse(localStorage.getItem(this.#userName));
    }
    set user(value) {
        localStorage.setItem(this.#userName, JSON.stringify(value));
    }

    isMessage() {
        return !!localStorage.getItem(this.#messageName);
    }

    clearMessage() {
        localStorage.removeItem(this.#messageName);
    }

    get message() {
        const message = localStorage.getItem(this.#messageName);
        return !message ? null : JSON.parse(message);
    }

    showMessage(type, message) {
        localStorage.setItem(
            this.#messageName,
            JSON.stringify({ type, message })
        );
    }
}

export class Api {
    #prefix = "/api";

    #session = new Session();

    constructor() {
        //
    }

    get prefix() {
        return this.#prefix;
    }

    get(path, query) {
        const token = this.#session.token;
        const url = `${this.prefix}${path}`;
        return window.axios.get(url, {
            params: query ?? {},
            headers: { Authorization: `Bearer ${token ?? ""}` },
        });
    }

    post(path, requestBody, query) {
        const token = this.#session.token;
        const url = `${this.prefix}${path}`;
        return window.axios.post(url, requestBody, {
            params: query ?? {},
            headers: { Authorization: `Bearer ${token ?? ""}` },
        });
    }

    put(path, requestBody, query) {
        const token = this.#session.token;
        const url = `${this.prefix}${path}`;
        return window.axios.put(url, requestBody, {
            params: query ?? {},
            headers: { Authorization: `Bearer ${token ?? ""}` },
        });
    }

    patch(path, requestBody, query) {
        const token = this.#session.token;
        const url = `${this.prefix}${path}`;
        return window.axios.patch(url, requestBody, {
            params: query ?? {},
            headers: { Authorization: `Bearer ${token ?? ""}` },
        });
    }

    delete(path, query) {
        const token = this.#session.token;
        const url = `${this.prefix}${path}`;
        return window.axios.delete(url, {
            params: query ?? {},
            headers: { Authorization: `Bearer ${token ?? ""}` },
        });
    }
}

export class Template {
    #target = null;

    constructor(target) {
        if (target instanceof HTMLTemplateElement) {
            this.#target = target;
        } else {
            throw new Exception("Not template.");
        }
    }

    get target() {
        return this.#target;
    }

    clone(wrapper) {
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }
        return wrapper(this.#target.content.cloneNode(true).firstElementChild);
    }
}

export class Component {
    #id = null;

    #target = null;

    #owner = null;

    #value = null;

    #components = [];

    constructor(target) {
        if (target instanceof HTMLTemplateElement) {
            this.#target = target.content.cloneNode(true).firstElementChild;
        } else if (target instanceof HTMLElement) {
            this.#target = target;
        } else if (target instanceof Component) {
            this.#target = target.target.cloneNode().firstElementChild;
        } else {
            throw new Exception("Unspported type target.");
        }
        if (!!this.#target.id) {
            this.#id = this.#target.id;
        }
    }

    get id() {
        return this.#id;
    }

    get target() {
        return this.#target;
    }

    get owner() {
        return this.#owner;
    }
    set owner(value) {
        this.#owner = value;
    }

    get checked() {
        return this.target.checked ?? false;
    }
    set checked(value) {
        this.target.checked = value;
    }

    get value() {
        return this.target.value ?? this.#value;
    }
    set value(value) {
        this.target.value = value ?? "";
    }

    get isChanged() {
        return this.value != this.#value;
    }

    get isVisible() {
        return this.target.checkVisibility() ?? false;
    }

    get text() {
        return this.target.textContent ?? null;
    }
    set text(value) {
        this.target.textContent = value;
    }
    get html() {
        return this.target.innerHTML ?? null;
    }
    set html(value) {
        this.target.innerHTML = value;
    }

    get attributeNames() {
        return this.target.getAttributeNames();
    }

    get clientRect() {
        return {
            top: this.target.clientTop,
            left: this.target.clientLeft,
            width: this.target.clientWidth,
            height: this.target.clientHeight,
            bottom: this.target.clientTop + this.target.clientHeight,
            right: this.target.clientLeft + this.target.clientWidth,
        };
    }

    get clientWidth() {
        return this.target.clientWidth;
    }

    get clientHeight() {
        return this.target.clientHeight;
    }

    get clientTop() {
        return this.target.clientTop;
    }

    get clientLeft() {
        return this.target.clientLeft;
    }

    get clientBottom() {
        return this.target.clientTop + this.target.clientHeight;
    }

    get clientRight() {
        return this.target.clientLeft + this.target.clientWidth;
    }

    get isFullscreen() {
        return this.target === document.fullscreenElement;
    }

    init() {
        //
        this.#components.forEach((component) => component.init());
        return true;
    }

    on(eventName, handler) {
        let method = null;
        if (typeof eventName === "string" && typeof handler === "undefined") {
            if (typeof this.id === "string") {
                const handlerName = `${this.id}_${eventName}`;
                if (typeof this.owner[handlerName] === "function") {
                    method = (e) => this.owner[handlerName](e);
                }
            } else if (typeof this.owner[eventName] === "function") {
                method = (e) => this.owner[eventName](e);
            } else {
                console.log({ eventName });
                throw new Exception("Illegal arguments of [on] method.");
            }
        } else if (
            typeof eventName === "string" &&
            typeof handler === "string"
        ) {
            if (typeof this.owner[handler] === "function") {
                method = (e) => this.owner[handler](e);
            }
        } else if (
            typeof eventName === "string" &&
            typeof handler === "function"
        ) {
            method = handler;
        } else {
            console.log({ eventName, handler });
            throw new Exception("Illegal arguments of [on] method.");
        }

        if (typeof method === "function") {
            this.target.addEventListener(eventName, method);
        }
        return this;
    }

    raise(eventName, detail) {
        const e = new CustomEvent(eventName, {
            cancelable: true,
            detail,
        });
        this.target?.dispatchEvent(e);
        return this;
    }

    attr(name, value) {
        if (typeof value === "undefined") {
            return this.target?.getAttribute(name) ?? null;
        } else {
            this.target?.setAttribute(name, value);
            return this;
        }
    }

    data(name, value) {
        if (typeof value === "undefined") {
            return this.target?.dataset[name] ?? null;
        } else if (this.target) {
            this.target.dataset[name] = value;
            return this;
        }
    }

    query(selector, wrapper) {
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }
        const dom = this.target.querySelector(selector);
        if (!dom) {
            throw new Exception(`Not found ${selector ?? "null"}`);
        }
        const result = wrapper(dom);
        result.owner = this;
        this.#components.push(result);
        return result;
    }

    queryAll(selector, wrapper) {
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }
        return Array.from(this.target?.querySelectorAll(selector))
            .map(wrapper)
            .map(
                (result) => (
                    (result.owner = this), this.#components.push(result), result
                )
            );
    }

    find(id, wrapper) {
        const selector = "#" + (!!this.id ? `${this.id}_${id}` : id);
        return this.query(selector, wrapper);
    }

    field(fieldName, wrapper) {
        return this.query(`[data-field='${fieldName}']`, wrapper);
    }

    fields(fieldName, wrapper) {
        return this.queryAll(`[data-field='${fieldName}']`, wrapper);
    }

    form(name, wrapper) {
        return this.query(`[name='${name}']`, wrapper);
    }

    form(name, wrapper) {
        return this.queryAll(`[name='${name}']`, wrapper);
    }

    clear() {
        this.target.remove();
        return this;
    }

    show() {
        this.target.hidden = false;
        return this;
    }

    hide() {
        this.target.hidden = true;
        return this;
    }

    replace(value) {
        this.target.outerHTML = value;
        return this;
    }

    append(dom, formatter) {
        if (dom) {
            if (dom instanceof Template) {
                this.target.appendChild(
                    dom.target.content.cloneNode(true).firstElementChild
                );
            } else if (dom instanceof HTMLTemplateElement) {
                this.target.appendChild(
                    dom.content.cloneNode(true).firstElementChild
                );
            } else if (dom instanceof Element) {
                this.target.appendChild(dom);
            } else if (dom instanceof Component) {
                this.target.appendChild(dom.target);
            } else if (typeof dom === "string") {
                this.target.append(dom);
            } else if (typeof dom === "function") {
                this.target.append(dom(formatter));
            } else {
                if (typeof dom === "number") {
                    if (typeof formatter === "undefined") {
                        formatter = (v) => String(v);
                    }
                } else {
                    if (typeof formatter === "undefined") {
                        formatter = (v) => JSON.stringify(v);
                    }
                }
                this.target.append(formatter(dom));
            }
        }
        return this;
    }

    parent(selector, wrapper) {
        if (this.target instanceof DocumentFlagment) {
            throw new Exception("this is flagment.");
        }
        if (typeof selector === "function" && !wrapper) {
            wrapper = selector;
            selector = undefined;
        }
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }

        if (typeof selector === "undefined") {
            return wrapper(this.target.parentElement);
        } else {
            const dom = this.target.closeset(selector);
            return !dom ? null : wrapper(dom);
        }
    }

    remove() {
        if (this.target.parent) {
            this.target.parent.childNodes.removeChild(this.target);
        }
        return this;
    }

    moveBefore() {
        if (!(this.target instanceof DocumentFragment)) {
            const previousDom = this.target.previousElementSibling;
            if (previousDom) {
                this.target.parent.childNodes.removeChild(this.target);
                previousDom.before(this.target);
            }
        }
        return this;
    }

    moveAfter(dom) {
        if (!(this.target instanceof DocumentFragment)) {
            const nextDom = this.target.nextElementSibling;
            if (nextDom) {
                this.target.parent.childNodes.removeChild(this.target);
                nextDom.after(this.target);
            }
        }
        return this;
    }

    before(dom) {
        if (dom instanceof Template) {
            this.target.before(
                dom.target.content.cloneNode(true).firstElementChild
            );
        } else if (dom instanceof HTMLTemplateElement) {
            this.target.before(dom.content.cloneNode(true).firstElementChild);
        } else if (dom instanceof Element) {
            this.target.before(dom);
        } else if (dom instanceof Component) {
            this.target.before(dom.target);
        } else if (typeof dom === "string") {
            this.target.before(dom);
        } else if (typeof dom === "function") {
            this.target.before(dom(formatter));
        } else {
            if (typeof dom === "number") {
                if (typeof formatter === "undefined") {
                    formatter = (v) => String(v);
                }
            } else {
                if (typeof formatter === "undefined") {
                    formatter = (v) => JSON.stringify(v);
                }
            }
            this.target.before(formatter(dom));
        }
        return this;
    }

    after(dom) {
        if (dom instanceof Template) {
            this.target.after(
                dom.target.content.cloneNode(true).firstElementChild
            );
        } else if (dom instanceof HTMLTemplateElement) {
            this.target.after(dom.content.cloneNode(true).firstElementChild);
        } else if (dom instanceof Element) {
            this.target.after(dom);
        } else if (dom instanceof Component) {
            this.target.after(dom.target);
        } else if (typeof dom === "string") {
            this.target.after(dom);
        } else if (typeof dom === "function") {
            this.target.after(dom(formatter));
        } else {
            if (typeof dom === "number") {
                if (typeof formatter === "undefined") {
                    formatter = (v) => String(v);
                }
            } else {
                if (typeof formatter === "undefined") {
                    formatter = (v) => JSON.stringify(v);
                }
            }
            this.target.after(formatter(dom));
        }
        return this;
    }

    fullscreen(value) {
        if (value ?? true) {
            if (!document.fullscreenElement) {
                this.target.requestFullscreen();
            }
        } else {
            if (this.target === document.fullscreenElement) {
                document.exitFullscreen();
            }
        }
        return this;
    }

    forward(url) {
        location.assign(url);
    }
}

export class Panel extends Component {
    #api = new Api();

    #session = new Session();

    constructor(target) {
        super(target);
        //
    }

    get api() {
        return this.#api;
    }

    get session() {
        return this.#session;
    }
}

export class InlineFrame extends Panel {
    constructor(target) {
        super(target);
        //
    }
}

export class Dialog extends Panel {
    constructor(target) {
        super(target);
    }

    show() {
        this.target.show();
        this.raise("shown");
        return this;
    }

    showModal() {
        this.target.showModal();
        this.raise("shown");
        return this;
    }

    close() {
        this.target.close();
        this.raise("closed");
        return this;
    }
}

export class Page extends Panel {
    #api = new Api();

    static run(page) {
        window.addEventListener("load", () => {
            if (!!page) {
                if (page.init()) {
                    page.show();
                }
            }
        });
    }

    constructor() {
        super(document.body);
    }

    get api() {
        return this.#api;
    }

    exitFullscreen() {
        document.exitFullscreen();
        return this;
    }
}
