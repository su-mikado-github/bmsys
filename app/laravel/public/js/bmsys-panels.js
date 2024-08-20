import { Panel } from "/wsi.js";

export class Header extends Panel {
    #mypage = this.find("mypage").on("click", "mypage_click");

    #menu = this.find("menu");

    #logout = this.find("logout").on("click", "logout_click");

    #loadUser() {
        this.api
            .get("/users")
            .then((response) => {
                this.session.user = response.data;
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
