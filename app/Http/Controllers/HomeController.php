<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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
    public function index()
    {
        //check if user is admin
        if(auth()->user()->hasRole('admin')){

            return redirect('/admin/dashboard');
            
        }
        return view('dashboard.pages.index', ['plan' => Plan::get_user_plan()]);
    }
}
