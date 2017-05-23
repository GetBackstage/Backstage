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

//routes with controllers
Route::get('/home'      , 'HomeController@index');
Route::get('/users'     , 'UsersController@show');
Route::get('addUser'   , 'UsersController@create');
Route::post('/addUser'  , 'UsersController@store')->name('addUser.store');
Route::get('/editUser/{id}' , 'UsersController@edit')->name('editUser.get');
Route::patch('/editUser/{id}', 'UsersController@update')->name('editUser.patch');

//route to views

Route::get('/editUser',function(){
    return view('/editUser');
});


//look up users via url

/*Route::get('/user' ,function(){

    $users = DB::table('users')->get();

    return $users;
});
*/

Route::get('/user/{user}', function ($id){

    $users = App\User::find($id);

    return view('/info', compact('users'));
});

