<?php

namespace App\Http\Controllers\front\home;

use App\Http\Controllers\Controller;
use App\Models\Logger;

class indexController extends Controller
{
    public function index()
    {
        $logger = Logger::limit(10)->orderByDesc("id")->get();
        return view("front.home.index", compact("logger"));
    }
    public function tumislemler()
    {
        $logger = Logger::orderByDesc("id")->get();
        return view("front.home.tumislemler", compact("logger"));
    }
}
