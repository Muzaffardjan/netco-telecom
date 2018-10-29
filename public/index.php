<?php

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

/**
 * @var \App\Http\Kernel $kernel
 */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

/**
 * @var \Illuminate\Http\Request $request
 * @var \Illuminate\Http\Response $response
 */
$response = $kernel->handle($request = Illuminate\Http\Request::capture());

$response->send();

$kernel->terminate($request, $response);
