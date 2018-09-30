<?php

// User CRUD
Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
Route::post('users', 'UserController@store');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@delete');

// Project CRUD
Route::get('projects', 'ProjectController@index');
Route::get('projects/{id}', 'ProjectController@show');
Route::post('projects', 'ProjectController@store');
Route::put('projects/{id}', 'ProjectController@update');
Route::delete('projects/{id}', 'ProjectController@delete');
