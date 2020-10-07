<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\product;
use App\User;
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
        $categories = category::orderBy('id','DESC')->limit(5)->get();
        $products = product::orderBy('id','DESC')->limit(5)->get();
        $users = User::orderBy('id','DESC')->limit(5)->get();
        return view('admin.index',compact('categories','products','users'));
    }
}
