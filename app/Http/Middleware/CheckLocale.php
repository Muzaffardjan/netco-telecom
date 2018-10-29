<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class CheckLocale
 * @package App\Http\Middleware
 */
class CheckLocale
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Redirector
     */
    protected $redirect;

    /**
     * @var Request
     */
    protected $request;

    /**
     * CheckLocale constructor.
     * @param Application $app
     * @param Redirector $redirect
     * @param Request $request
     */
    public function __construct(Application $app, Redirector $redirect, Request $request)
    {
        $this->app = $app;
        $this->redirect = $redirect;
        $this->request = $request;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (! array_key_exists($locale, $this->app->config->get('app.locales'))) {
            $segments = $request->segments();

            $new[] = $this->app->config->get('app.fallback_locale');

            foreach ($segments as $segment) {
                $new[] = $segment;
            }

            return $this->redirect->to(implode('/', $new));
        }

        $this->app->setLocale($locale);

        return $next($request);
    }
}
