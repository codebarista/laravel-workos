<?php

use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Requests\AuthKitAuthenticationRequest;
use Laravel\WorkOS\Http\Requests\AuthKitLoginRequest;
use Laravel\WorkOS\Http\Requests\AuthKitLogoutRequest;

Route::middleware('guest')->group(static function () {
    Route::get(config('laravel-workos.routes.authenticate', default: 'authenticate'), static function (AuthKitAuthenticationRequest $request) {
        return tap(to_route(config('laravel-workos.redirect.to_route_name')), static fn () => $request->authenticate());
    })->name('authenticate');
    Route::get(config('laravel-workos.routes.login', default: 'login'), static function (AuthKitLoginRequest $request) {
        return $request->redirect();
    })->name('login');
});

Route::middleware('auth')->group(static function () {
    Route::post(config('laravel-workos.routes.logout', default: 'logout'), static function (AuthKitLogoutRequest $request) {
        return $request->logout();
    })->name('logout');
});
