<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request ){
        $validated=$request->validated();
        $path=null;
        if($request->hasFile('image')){
            $path=$request->file('image')->store('profilePics','public');
        }
        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>$validated['password'],
            'remember_token'=> Str::random(10),
            'imagePath'=>$path

        ]);
        return redirect()->route('loginForm')->with('success','User Registered');
    }
    public function login(LoginRequest $request){
    $validated = $request->validated();
    if (!Auth::attempt($validated)) {  //finds user by email,checks hashed password,logs user in,sets session
    return back()->with('error', 'Invalid credentials');
}
    $request->session()->regenerate();
    return redirect()->route('posts.all')->with('success', 'Logged in');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with(['success'=>'Logged out successfully']);
    }
}

    

