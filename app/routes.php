<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home', array('user' => Auth::user()));
});

Route::get('/test', function(){
	$data = "Drnutsu";
	return View::make('showData')->with('data',$data);
});

Route::get('/signup', 'CustomerController@form');

Route::post('user', 'CustomerController@create');

Route::get('/login', 'CustomerController@loginForm');

Route::post('/login',function()
{
  $credentials = Input::only('username', 'password');
  if(Auth::attempt($credentials)){
    return Redirect::to('/');
  }
  return Redirect::to('login');
});

Route::get('/logout', function(){
  Auth::logout();
  return Redirect::to('/');
});
