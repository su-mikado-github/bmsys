<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    //
    public function __invoke(Request $request) {
        //
        logger()->debug($request->user());

        return view('pages.mypage');
    }
}
