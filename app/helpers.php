<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
}
