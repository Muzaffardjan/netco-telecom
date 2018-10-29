<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 14:38
 */

/**
 * @var \Illuminate\Support\ViewErrorBag $errors
 */
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Login page for Admin panel">
    <meta name="author" content="Muzaffardjan Karaev">
    <title>{{ __('auth_login.title') }}</title>

    <link rel="stylesheet" href="{{ asset('dashboard/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/main.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">
                        <img src="{{ asset('dashboard/img/logo.svg') }}" alt="Netco Telecom">
                    </h3>
                </div>

                <div class="panel-body">
                    <form role="form" method="post" action="{{ route('admin.login', ['locale' => app()->getLocale()]) }}">
                        @if($errors->has('auth_error'))
                            <div class="alert alert-danger" role="alert">
                                {{ __('auth_login.auth_error') }}
                            </div>
                        @endif

                        {{ csrf_field() }}

                        <fieldset>
                            @if($errors->has('username'))
                                <div class="form-group has-error">
                                    <label class="control-label">
                                        {{ __('auth_login.' . $errors->first('username')) }}
                                    </label>
                            @else
                                <div class="form-group">
                            @endif
                                <input class="form-control" placeholder="{{ __('auth_login.username') }}" name="username" type="text" value="{{ old('username') }}">
                            </div>

                            @if($errors->has('password'))
                                <div class="form-group has-error">
                                    <label class="control-label">
                                        {{ __('auth_login.' . $errors->first('password')) }}
                                    </label>
                            @else
                                <div class="form-group">
                            @endif
                                <input class="form-control" placeholder="{{ __('auth_login.password') }}" name="password" type="password">
                            </div>

                            <button class="btn btn-success btn-block" type="submit">
                                {{ __('auth_login.login') }}
                                <i class="fa fa-sign-in"></i>
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

