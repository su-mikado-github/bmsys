@push('headers')
<nav id="{{ $attributes->get('id') }}" class="{{ $attributes->merge([ 'class'=>'navbar navbar-expand-lg bg-body-tertiary' ])->get('class') }}">
<div class="container-fluid">
    <a class="navbar-brand m-0" href="/"><x-icon name="mdi mdi-home-account" />{{ config('app.name') }}</a>
    <div class="d-flex flex-row">
        <button id="{{ $attributes->get('id') }}_mypage" class="btn px-2">
            <x-icon name="mdi mdi-account-box" />マイページ
        </button>
        {{-- <button id="{{ $attributes->get('id') }}_logout" class="btn px-2">
            <x-icon name="mdi mdi-logout" />ログアウト
        </button> --}}
        <div id="{{ $attributes->get('id') }}_menu" class="dropdown" hidden>
            <button class="btn dropdown-toggle px-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <x-icon name="mdi mdi-microsoft-xbox-controller-menu" />メニュー
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item active" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a id="{{ $attributes->get('id') }}_logout" class="dropdown-item" href="#"><x-icon name="mdi mdi-microsoft-xbox-controller-menu" />ログアウト</a></li>
            </ul>
        </div>
{{--
        <div class="dropdown-menu">
            <div class="d-flex flex-column flex-md-row justify-content-end px-3">
                <div class="d-flex flex-column">
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー１－１</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー１－２</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー１－３</a>
                </div>
                <div class="vr d-none d-md-inline-block mx-3"></div>
                <hr class="d-block d-md-none">
                <div class="d-flex flex-column">
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー２－１</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー２－２</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー２－３</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー２－４</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー２－５</a>
                </div>
                <div class="vr d-none d-md-inline-block mx-3"></div>
                <hr class="d-block d-md-none">
                <div class="d-flex flex-column">
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー３－１</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー３－２</a>
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー３－３</a>
                </div>
                <hr class="d-block d-md-none">
                <div class="d-flex flex-column">
                    <a class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap">メニュー３－１</a>
                </div>
            </div>
        </div> --}}
    </div>
</div>
</nav>
@endpush

