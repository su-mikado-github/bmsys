<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController extends Controller
{
    //
    public function head() {
        //
        return response()->json(date('Y-m-d H:i:s'));
    }
}
