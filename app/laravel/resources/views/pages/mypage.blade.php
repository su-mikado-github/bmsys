@extends('pages.burger-layout')

<x-script>
import { Page } from "/wsi.js";
import { Header } from "/js/bmsys-panels.js";

class Mypage extends Page {
    #header = this.find("header", (dom)=>new Header(dom));

    constructor() {
        super();
    }

    show() {
        super.show();
    }
}

Page.run(new Mypage());
</x-script>

@push('headers')
<x-panels.header id="header" class="p-2" />
@endpush

@section('main')
<h1>マイページ</h1>
@endsection

@push('footers')
<x-panels.footer id="footer" />
@endpush
