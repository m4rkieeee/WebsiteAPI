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
        $todo = Todo::with('user')->get();
        return view('home', compact('todo'));
    }
    public function cards() {
        $todo = Todo::with('user')->get();
        return view('cards', compact('todo'));
    }
}
