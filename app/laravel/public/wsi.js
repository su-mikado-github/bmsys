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
    #target = null;

    #owner = null;

    #value = null;

    constructor(target, owner) {
        if (target instanceof HTMLTemplateElement) {
            this.#target = target.content.cloneNode(true).firstElementChild;
        } else if (target instanceof HTMLElement) {
            this.#target = target;
        } else if (target instanceof Component) {
            this.#target = target.target.cloneNode().firstElementChild;
        } else {
            throw new Exception("Unspported type target.");
        }
        this.#owner = owner;
    }

    get id() {
        return this.target.id;
    }

    get target() {
        return this.#target;
    }

    get owner() {
        return this.#owner;
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
        return true;
    }

    on(eventName, handler) {
        if (typeof handler === "undefined") {
            if (typeof this.id === "string") {
                const handlerName = `${this.id}_${eventName}`;
                if (typeof this[handlerName] === "function") {
                    this.target.addEventListener(eventName, this[handlerName]);
                }
            }
        } else if (typeof handler === "string") {
            if (typeof this[handler] === "function") {
                this.target.addEventListener(eventName, this[handler]);
            }
        } else if (typeof handler === "function") {
            this.target.addEventListener(eventName, handler);
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

    find(selector, wrapper) {
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }
        const dom = this.target.querySelector(selector);
        if (!dom) {
            throw new Exception(`Not found ${selector ?? "null"}`);
        }
        return wrapper(dom);
    }

    finds(selector, wrapper) {
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }
        return Array.from(this.target?.querySelectorAll(selector)).map(wrapper);
    }

    nameOf(name, wrapper) {
        if (typeof wrapper === "undefined") {
            wrapper = (dom) => new Component(dom);
        }
        const domList = Array.from(
            this.target?.querySelectorAll(`[name='${name}']`)
        );
        if (domList.length === 1) {
            return wrapper(domList.shift());
        } else if (domList.length > 0) {
            return domList.map(wrapper);
        } else {
            return null;
        }
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
}

export class Panel extends Component {
    constructor(target) {
        super(target);
        //
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

    exitFullscreen() {
        document.exitFullscreen();
        return this;
    }
}
