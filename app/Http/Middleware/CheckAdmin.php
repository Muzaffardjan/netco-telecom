<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 14:15
 */
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory;

class CheckAdmin
{
    /**
     * @var Factory
     */
    protected $auth;

    /**
     * CheckAdmin constructor.
     * @param Factory $auth
     */
    public function __construct(Factory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->check($request, $guards);

        return $next($request);
    }

    /**
     * @param $request
     * @param array $guards
     * @throws AuthenticationException
     */
    public function check($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException('Unauthenticated', $guards, $this->redirectTo($request));
    }

    /**
     * @param $request
     * @return string
     */
    public function redirectTo($request)
    {
        return route('admin.login', ['locale' => app()->getLocale()]);
    }
}
