<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ActionController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends ActionController
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->proof_balance(); // schetida qancha pul borligini hisoblash

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        return view('myprofile');
    }

    public function update_profile(UserRequest $request)
    {
        $user = User::find(Auth::id());

        $image = "";
        if($request->hasFile('image')){
            $image = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('/images'), $image);
        }

        $user->path = $image;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('message', 'Данные пользователя успешно сохранено.');
    }
}
