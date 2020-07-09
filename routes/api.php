<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\\LoginJwtController@teste');
Route::post('/login', 'Auth\\LoginJwtController@login')->name('login');

Route::get('/teste2', 'Auth\\LoginJwtController@teste2')->middleware('jwt.auth');
Route::get('/logout', 'Auth\\LoginJwtController@logout')->name('logout');
Route::get('/refresh', 'Auth\\LoginJwtController@refresh')->name('refresh');
