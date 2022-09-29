<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
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
        $todo = Todo::all();
        $users = User::all();
        return view('home', compact('users', 'todo'));
    }
    public function cards() {
        $todo = Todo::all();
        $users = User::all();
        return view('cards', compact('users', 'todo'));
    }
}
