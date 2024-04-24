<?php

namespace App\Http\Controllers;

use App\Events\AdminLoginEvent;
use App\Events\LoginEvent;
use App\Http\Requests\AuthLoginRequest;
use App\Jobs\DemoJob;
use App\Mail\AdminLoginMail;
use App\Notifications\LogoutNotification;
use App\Notifications\MyNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(AuthLoginRequest $request)
    {
        $credentials = $request->validated();

        $res = LoginEvent::dispatchIf(true, $credentials, $request);
        if (sizeof($res) > 0) {
            if ($res[0]) {
                // Send new Email when user login
                event(new AdminLoginEvent());
                // Mail::send(new AdminLoginMail());
                return redirect()->intended(route('admin.property.index'));
            } else {
                return to_route('login')->with('error', 'Identifiant incorrect')
                    ->onlyInput('email');
            }
        } else {
            return to_route('login')->with('error', 'Identifiant incorrect')
                ->onlyInput('email');
        }

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended(route('admin.property.index'));
        // }

        // return to_route('login')->withErrors('email', 'Identifiant incorrect')
        //     ->onlyInput('email');

    }

    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Vous êtes maintenant déconnecté !');
    }
}
