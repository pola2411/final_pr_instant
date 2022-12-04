<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\api\DrivesController;

Route::post('register','AuthController@register')->name('register');
 Route::post('login',"AuthController@login");
 Route::get("/","api\DrivesController@index")->name("drives.index");
Route::middleware("auth:sanctum")->group(function(){
Route::prefix("drives")->group(function(){


    Route::get('logout',"AuthController@logout");
    Route::post('store',"api\DrivesController@store");
    Route::get("show/{id}","api\DrivesController@show");
    Route::post("update/{id}","api\DrivesController@update");
    Route::delete("delete/{id}","api\DrivesController@destroy");
});
});
