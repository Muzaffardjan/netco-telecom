<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 27.10.2018 / 16:37
 */

/**
 * @var \Illuminate\Support\ViewErrorBag $errors
 */
?>

<?php
var_dump(
    $errors
);
?>

<form action="{{ route('register', ['locale' => app()->getLocale()]) }}" method="post">
    {{ csrf_field() }}

    <input type="text" name="username" placeholder="{{ __('register.username') }}" value="{{ old('username') }}">
    <input type="email" name="email" placeholder="{{ __('register.email') }}" value="{{ old('email') }}">
    <input type="password" name="password" placeholder="{{ __('register.password') }}">
    <input type="password" name="password_confirmation" placeholder="{{ __('register.password_confirmation') }}">
    <input type="text" name="fullname" placeholder="{{ __('register.fullname') }}" value="{{ old('fullname') }}">
    <input type="text" name="telephone" placeholder="{{ __('register.telephone') }}" value="{{ old('telephone') }}">
    <button type="submit">
        {{ __('register.save') }}
    </button>
</form>
