<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();

        $url = '';
        //Redirect user based on their role (1 = admin, 2 = user, 3 = poster)
        if($request->user()->role_id == '1') {
            $url = '/admin/dashboard';
        }elseif($request->user()->role_id == '2'){ 
            $url = '/dashboard';
        }elseif($request->user()->role_id == '3'){
            $url = '/posts';
        }
        elseif($request->user()->role_id == '4'){
            $url = '/seeker/dashboard';
        }
    
        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
