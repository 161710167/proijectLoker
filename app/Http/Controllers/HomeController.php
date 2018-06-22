<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Laratrust::hasRole('admin')) return $this->adminDasboard();
        if (Laratrust::hasRole('member')) return $this->memberDasboard();
        return view('home');
    }
    public function adminDasboard(){
        return view('admin.index');


    }
    public function memberDasboard(){
    return view('home');
    }
}
