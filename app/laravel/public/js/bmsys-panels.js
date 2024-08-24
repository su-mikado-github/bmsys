import { Panel } from "/wsi.js";

export class Header extends Panel {
    #mypage = this.find("mypage").on("click", "mypage_click");

    #menu = this.find("menu");

    #menuItems = this.find("menuItems");

    #logout = this.find("logout").on("click", "logout_click");

    #menuItemTemplate(menuItem) {
        return `<li>
    <a class="dropdown-item" href="${menuItem.screen?.url ?? "#"}">
        <i class="${
            menuItem.screen?.icon ?? "mdi mdi-arrow-right-drop-circle-outline"
        }"></i>&nbsp;${menuItem.screen?.short_name ?? "(不明)"}
    </a>
</li>`;
    }

    #loadUser() {
        this.api
            .get("/users")
            .then((response) => {
                this.session.user = response.data.user;
                const menuItems = response.data.menu_items.map((menuItem) =>
                    this.#menuItemTemplate(menuItem)
                );
                this.#menuItems.html = menuItems.join("");
                this.#menu.show();
                this.#logout.show();
            })
            .catch((response) => {
                //
                this.session.clearUser();
                this.#menu.hide();
                this.#logout.hide();
            });
    }

    #logoutUser() {
        this.api.post("/logout").then((response) => {
            this.session.clearUser();
            this.#menu.hide();
            this.#logout.hide();
            this.forward("/");
        });
    }

    constructor(target) {
        super(target);
    }

    init() {
        super.init();
        //
        this.#loadUser();
    }

    mypage_click(e) {
        //
        if (this.session.isUser()) {
            this.forward("/mypage");
        } else {
            this.forward("/attest");
        }
    }

    logout_click(e) {
        //
        this.#logoutUser();
    }
}
