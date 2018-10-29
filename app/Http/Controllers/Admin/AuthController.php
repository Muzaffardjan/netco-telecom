<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 14:29
 */
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\SessionGuard;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends AbstractAdminController
{
    protected $redirectTo = '/adminjohn';

    protected $maxAttempts = 5;

    protected $decayMinutes = 1;

    /**
     * @param Request $request
     */
    public function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages(['auth_error' => 'Login or Password wrong.']);
    }

    /**
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }

    /**
     * @param Request $request
     */
    public function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit($this->throttleKey($request), $this->decayMinutes());
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
//    protected function redirectTo()
//    {
//        return redirect()->route('admin', ['locale' => app()->getLocale()]);
//    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
     * @param Request $request
     * @param $user
     */
    public function authenticated(Request $request, $user)
    {
        // TODO
    }

    /**
     * @param Request $request
     */
    public function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }

    /**
     * @param Request $request
     * @return array
     */
    public function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        /**
         * @var SessionGuard $guard
         */
        $guard = $this->guard();

        return $guard->attempt($this->credentials($request), $request->filled('remember'));
    }

    /**
     * @param Request $request
     */
    public function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'username' => [
                Lang::get('auth.throttle', ['seconds' => $seconds])
            ],
        ])->status(429);
    }

    /**
     * @param Request $request
     */
    public function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    /**
     * @return int
     */
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function throttleKey(Request $request)
    {
        return Str::lower($request->input('username')) . '|' . $request->ip();
    }

    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function limiter()
    {
        return app(RateLimiter::class);
    }

    public function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            $this->maxAttempts()
        );
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ],
            [
                'required' => 'The :attribute field is required',
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validateLogin($request);

            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        }

        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.login', ['locale' => app()->getLocale()]);

//        return $this->loggedOut($request) ?: redirect('/');
    }
}
