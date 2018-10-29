<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 14:16
 */
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

/**
 * Class AdminAuth
 * @package App\Http\Middleware
 */
class AdminAuth
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
