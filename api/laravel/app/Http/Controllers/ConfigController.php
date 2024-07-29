<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    //
    public function index() {
        $bmsys = [
            'app' => config("app"),
        ];

        return response(view('config/index', [ 'bmsys'=>$bmsys ]))
            ->header('Content-Type', 'text/javascript');
    }
}
