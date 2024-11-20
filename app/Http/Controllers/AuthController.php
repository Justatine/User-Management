<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __invoke(){
        return view('pages.test');
    }  

    public function gotoSignIn(){
        return view('pages.auth.sign-in');
    }

    public function gotoSignUp(){
        return view('pages.auth.sign-up');
    }

    public function profile(){
        $user = Auth::user();
        return view('pages.profile.profile',[
            'user' => $user
        ]);
    }
    public function login(){
        Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]); 

        if(auth()->attempt(request()->only('email', 'password'))){
            $user = auth()->user();
            switch ($user->role) {
                case 'Admin':
                    return redirect('/dashboard')
                    ->with('success', true)
                    ->with('message', 'Login successful');                    
                case 'Client':
                    return redirect('/home')
                    ->with('success', true)
                    ->with('message', 'Login successful');
                default:
                    return redirect('/');
            } 
        }

        return redirect()
        ->back()
        ->withErrors(['email' => 'Invalid credentials']); 
    }

    public function register(){
        Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:8',
        ]); 

        User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]); 

        return redirect('/sign-in')
        ->with('success', true)
        ->with('message', 'Registration successful');   
    }   

    public function logout(){
        auth()->logout();
        return redirect('/sign-in')
        ->with('success', true)
        ->with('message', 'Logout successful');
    }   
}
