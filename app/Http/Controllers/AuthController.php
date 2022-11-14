<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect('/home');

        } else {
            return view('auth.login');
        }
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home')->withSuccess('Signed in!');
        } else {
            return redirect()->back()->with('invalidPassword', 'Invalid username or password!');

        }
    }
    public function registration()
    {
        if (auth()->user()) {
            return redirect('/home');
        } else {
            return view('auth.register');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function customRegistration(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $this->validator($request->all())->validate();
        event(new User($user = $this->create($request->all())));
        $this->guard()->login($user);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        $userRoles = new userRoles();
        $userRoles->user_id = $user->id;
        $userRoles->role_id = $request->role ?? userRoles::user;
        $userRoles->save();

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home')->withSuccess('Signed in!');
        } else {
            return redirect()->back()->with('success', 'User created!');
        }

    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }

    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('welcome');
        }
        return redirect("login")->withSuccess('are not allowed to access');
    }

    public function signOut() {
        Auth::logout();

        return redirect('login');
    }
}
