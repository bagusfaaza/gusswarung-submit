<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email wajid disi',
                'password.required' => 'password wajid disi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->email === 'admin@gmail.com') {
                return redirect('/admin');
            } else if (Auth::user()->email === 'user@gmail.com') {
                return redirect('/user');
            } else {
                return redirect('/driver');
            }

        } else {
            return redirect('')->back()->withErrors('username dan password salah')->withInput();
        }
    }

    function logout()
    {
        return redirect('');
    }
}