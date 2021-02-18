<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;


Route::group(['prefix' => '/champions/v2/maps', 'as'=> 'champions.maps.'], function()
{
    Route::post('/distance',[LocationController::class,'getDistance'])->name('distance');
});