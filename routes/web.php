<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('',function(){
return view("welcome");

});

Route::get('401','DrivesController@goto')->name('go.401');
Route::get('/admin_login', "AdminController@goadmin")->name("admin.login");

Route::get("dashboard","AdminController@dashboard")->name("dashboard")->middleware('auth:admin');
Route::post("/logins",'AdminController@login')->name("logins");
Route::middleware('auth')->group(function(){
    Route::get('home',function(){
        return view('home');

        });
Route::prefix('drives')->group(function(){
Route::get('/',"DrivesController@index")->name("drives.index");
Route::get('public','DrivesController@all_index')->name("drives.public");
Route::get('status/{id}','DrivesController@status')->name("drives.status");

Route::get("create",'DrivesController@create')->name("drives.create");
Route::post("store","DrivesController@store")->name("drives.store");
Route::get("show/{id}","DrivesController@show")->name("drives.show");
Route::get("edit/{id}","DrivesController@edit")->name("drives.edit");
Route::post("update/{id}","DrivesController@update")->name("drives.update");
Route::get("delete/{id}","DrivesController@destroy")->name("drives.destroy");
Route::get('download{id}','DrivesController@download')->name('drives.downlaod');


});
});
