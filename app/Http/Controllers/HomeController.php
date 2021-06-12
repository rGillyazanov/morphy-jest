<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function jests()
    {
        return view('jests');
    }

    public function words()
    {
        return view('words');
    }

    public function statistics()
    {
        return view('statistics');
    }

    public function intersections()
    {
        return view('intersections');
    }
}
