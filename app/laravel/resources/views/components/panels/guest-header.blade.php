@push('headers')
<nav id="{{ $attributes->get('id') }}" class="{{ $attributes->merge([ 'class'=>'navbar navbar-expand-lg bg-body-tertiary' ])->get('class') }}">
<div class="container-fluid">
    <a class="navbar-brand m-0" href="/"><x-icon name="mdi mdi-home-account" />{{ config('app.name') }}</a>
    <div class="flex-grow-1 d-flex flex-row justify-content-end px-2">
        <a id="login" class="link-offset-3-hover link-underline-opacity-0 link-underline-opacity-75-hover link-underline-dark text-dark text-nowrap" href="#"><x-icon name="mdi mdi-login" />ログイン</a>
    </div>
</div>
</nav>
@endpush

