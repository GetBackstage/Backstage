<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/user', function () {
    $users = DB::table('users')->get();

    return $users;
});

Route::get('/user/{user}', function ($id){

    $users = App\User::find($id);

    return view('/info', compact('users'));
});

Route::get('/users', function (){
   $users = DB::table('users')->get();
    return view('/users', compact('users'));
});

Route::get('/addUser',function(){
    return view('/addUser');
});

Route::get('/editUsers',function(){
    return view('/editUsers');
});