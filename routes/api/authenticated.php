<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auths'], function () {
	Route::get('/userSession', 'UserSessionController@execute');
	Route::post('/logout', 'LogoutController@execute');
});