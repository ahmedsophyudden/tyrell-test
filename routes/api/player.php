<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Players', 'prefix' => 'players'], function () {
    Route::post('/give-cards', 'PlayerGiveCardController@execute');
});