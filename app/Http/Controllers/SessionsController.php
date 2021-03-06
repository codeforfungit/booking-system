<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    // admin login
    public function create()
    {
        return view('admin.sessions.create');
    }

    public function store()
    {
        if (! auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/admin/login');
    }

    // client login
    public function clientCreate()
    {
        return view('client.sessions.create');
    }

    public function clientStore()
    {
        if (! auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        return redirect()->route('clientDashboard');
    }

    public function clientDestroy()
    {
        auth()->logout();
        return redirect('/client/login');
    }
}