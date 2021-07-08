<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace'=>'API'],function(){
    ################################Auth Routes ##############################################
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('loginnbbcnn', 'AuthController@login');
        Route::post('reggbbnn', 'AuthController@register');
    });

    Route::group(['middleware'=>'auth:sanctum'],function(){
    ################################user Routes ##############################################
        Route::group(['prefix' => 'user','namespace'=>'User'],function(){
            Route::group(['prefix' => 'reservation'],function(){
                Route::get('index', 'ReservationController@index');
                Route::any('store', 'ReservationController@store');
                Route::get('show/{id}', 'ReservationController@show');
                Route::post('update/{id}', 'ReservationController@update');
                Route::any('destroy/{id}', 'ReservationController@destroy');
            });
            Route::group(['prefix' => 'profile'],function(){
                Route::get('show-data-user/{id}', 'ProfileController@showDataUser');
                Route::post('update/{id}', 'ProfileController@update');
            });
        });
    ################################doctor Routes ##############################################
        Route::group(['prefix' => 'doctor','namespace'=>'Doctor'],function(){
                Route::get('show-all-users-for-me-doctor', 'DoctorController@showAllUsersForMeDoctor');
            Route::group(['prefix' => 'profile'],function(){
                Route::get('show-data-user/{id}', 'ProfileController@showDataUser');
                Route::post('update/{id}', 'ProfileController@update');
            });
        });
    ################################Admin Routes ##############################################
        Route::group(['prefix' => 'admin','namespace'=>'Admin'],function(){
            Route::group(['prefix' => 'doctors'],function(){
                Route::get('index', 'DoctorController@index');
                Route::any('store', 'DoctorController@store');
                Route::get('show-all-users-doctorr/{id}', 'DoctorController@showAllUsersDoctor');
                Route::get('show/{id}', 'DoctorController@show');
                Route::post('update/{id}', 'DoctorController@update');
                Route::any('destroy/{id}', 'DoctorController@destroy');    
            });
            Route::group(['prefix' => 'users'],function(){
                Route::get('index', 'UserController@index');
                Route::any('store', 'UserController@store');
                Route::get('show/{id}', 'UserController@show');
                Route::post('update/{id}', 'UserController@update');
                Route::any('destroy/{id}', 'UserController@destroy');    
            });
            Route::group(['prefix' => 'profile'],function(){
                Route::get('show-data-admin/{id}', 'ProfileController@showDataAdmin'); 
            });
        });
    });
});