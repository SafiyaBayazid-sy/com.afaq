<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('can')) {
    function can($permission)
    {
        return Auth::check() && Auth::user()->can($permission);
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return Auth::check() && Auth::user()->user_type === 'admin';
    }
}

if (!function_exists('isCustomer')) {
    function isCustomer()
    {
        return Auth::check() && Auth::user()->user_type === 'customer';
    }
}