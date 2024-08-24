<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    //
    public function __invoke(Request $request) {
        return view('pages.members');
    }
}
