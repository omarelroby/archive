<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});






