<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auths'], function () {
	Route::post('/register', 'RegisterController@execute');
	Route::post('/login', 'LoginController@execute');
	Route::post('/loginToken', 'LoginTokenController@execute');
	Route::post('/changePassword', 'ChangePasswordController@execute');
	Route::post('/forgot', 'ForgotPasswordController@execute');
	Route::post('/submitresetPassForm', 'ResetPasswordController@execute');
});