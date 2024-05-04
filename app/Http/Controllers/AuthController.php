<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Http\Requests\SignInFormRequest;
use App\Http\Requests\SignUpFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('auth.index');
    }

    public function signUp()
    {
        return view('auth.sign-up');
    }

    public function forgot()
    {
        return view('auth.forgot-password');
    }

    public function signIn(SignInFormRequest $request): RedirectResponse
    {
        if(!auth()->attempt($request->validated())){
            return back()->withErrors([
                'email' => 'wrong user or password',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function store(SignUpFormRequest $request): RedirectResponse
    {
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        event(new Registered($user));
        auth()->login($user);

        return redirect()->intended(route('home'));
    }

    public function logOut(Request $request): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()
            ->route('home');
    }

    public function forgotPassword(ForgotPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status === Password::RESET_LINK_SENT)
        {
            flash()->info(__($status));
            return back();
        }
        return back()->withErrors(['email' => __($status)]);
    }

    public function reset (string $token): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.reset-password', [
            'token' => $token
        ]);
    }

    public function resetPassword(ResetPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(str()->random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET)
        {
            flash()->info(__($status));
            return redirect()->route('login');
        }
        return back()->withErrors(['email' => __($status)]);
    }

    public function github(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver('github')
            ->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => bcrypt(str()->random(20))
        ]);

        auth()->login($user);

        return redirect()->intended(route('home'));
    }

}
