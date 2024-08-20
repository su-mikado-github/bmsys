<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttestController extends Controller
{
    //
    public function __invoke(Request $request) {
        $redirect_to = $request->input('redirect_to');
        return view('pages.attest', compact('redirect_to'));
    }
}
