<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test.js', function () {
    return response(view('scripts/test'), 200)->header('Content-Type', 'text/javascript');
});
