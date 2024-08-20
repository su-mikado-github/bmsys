@extends('pages.burger-layout')

@use(Illuminate\Support\Facades\Auth)

<x-script>
import { Page } from "/wsi.js";
import { Header } from "/js/bmsys-panels.js";

class Attest extends Page {
    #redirectTo = @json($redirect_to);

    #header = this.find("header", (dom)=>new Header(dom));

    #loginId = this.find("loginId");

    #loginPw = this.find("loginPw");

    #login = this.find("login").on("click");

    #test = this.find("test").on("click");

    #logout = this.find("logout").on("click");

    #getUsers() {
        this.api.get("/users")
            .then((response)=>{
                console.log(response.data);
            })
            .catch((response)=>{
                console.log(response);
            });
    }

    constructor() {
        super();
    }

    show() {
        super.show();
    }

    login_click(e) {
        const requestBody = {
            email: this.#loginId.value,
            password: this.#loginPw.value,
        };
        this.api.post("/users-attest", requestBody)
            .then((response)=>{
                console.log(response);
                this.session.token = response.data.api_token;
                this.forward(this.#redirectTo ?? '/mypage');
            })
            .catch((response)=>{
                console.log(response);
                this.session.showMessage("error", response.data.message);
            });
    }

    test_click(e) {
        this.#getUsers();
    }

    logout_click(e) {
        this.api.post("/logout")
            .then((response)=>{
                this.session.clearToken();
                this.forward("/");
            });
    }
}

Page.run(new Attest());
</x-script>

@push('headers')
<x-panels.header id="header" class="p-2" />
@endpush

@section('main')
<div class="d-flex justify-content-center align-items-center">
    <div class="card col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 shadow">
        <div class="card-header bg-primary">
            <h6 class="text-white m-0">認証</h6>
        </div>
        <div class="card-body">
            <div>
                <label for="loginId" class="form-label">ID</label>
                <input id="loginId" type="text" name="login_id" class="form-control" placeholder="社員番号">
                <p data-name="login_id" class="bmsys-annotation"></p>
            </div>
            <div>
                <label for="loginPw" class="form-label">パスワード</label>
                <input id="loginPw" type="password" name="login_pw" class="form-control" placeholder="">
                <p data-name="login_pw" class="bmsys-annotation"></p>
            </div>
        </div>
        <div class="card-footer">
            <div class="row gx-3">
                <div class="col-2"></div>
                <div class="col-4">
                    <a type="button" class="col-12 btn btn-outline-secondary text-nowrap" href="/">キャンセル</a>
                </div>
                <div class="col-4">
                    <button id="login" type="button" class="col-12 btn btn-primary text-nowrap">ログイン</button>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footers')
<x-panels.footer id="footer" />
@endpush
