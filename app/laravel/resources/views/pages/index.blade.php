@extends('pages.burger-layout')

<x-script>
import { Page } from "/wsi.js";
import { Header } from "/js/bmsys-panels.js";

class Index extends Page {
    #header = this.find("#header");

    constructor() {
        super();
    }

    show() {
        super.show();
    }
}

Page.run(new Index());
</x-script>

@push('headers')
@auth
<x-panels.header id="header" class="p-2" />
@else
<x-panels.guest-header id="header" class="p-2" />
@endauth
@endpush

@section('main')
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
<h1>Hello world !!</h1>
@endsection

@push('footers')
<x-panels.footer id="footer" />
@endpush
