<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        //$this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.app');
        //return view('home');
    }
    public function widgets()
    {
        $posts= Post::all()->count();
        $roles= Role::all()->count();
        $permission= Permission::all()->count();
        $users= User::all()->count();

        return view('admin.home.index', compact(['posts','users','permission','roles']));
    }
}
