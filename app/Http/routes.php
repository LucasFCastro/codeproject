<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function(){
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware'=>'oauth'], function(){

    Route::resource('client', 'ClientController', ['exception' => ['create', 'edit']]);

//    Route::get('client', 'ClientController@index');
//    Route::get('client/{id}', 'ClientController@show');
//    Route::post('client', 'ClientController@store');
//    Route::put('client/{id}', 'ClientController@update');
//    Route::delete('client/{id}', 'ClientController@destroy');

//    Route::group(['middleware'=>'CheckProjectOwner'], function(){
//        Route::resource('project', 'ProjectController', ['exception' => ['create', 'edit']]);
//    });

    Route::resource('project', 'ProjectController', ['exception' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function(){

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');

    });

//    Route::get('project', 'ProjectController@index');
//    Route::get('project/{id}', 'ProjectController@show');
//    Route::post('project', 'ProjectController@store');
//    Route::put('project/{id}', 'ProjectController@update');
//    Route::delete('project/{id}', 'ProjectController@destroy');

});


