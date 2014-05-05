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
	return View::make('hello');
});
Route::get('users/register',                        // url
    array('as'=>'register',                         // route name
        'uses'=>'UsersController@get_register'))
        	->before('guest');   // action
Route::post('users/create',                         // url
    array('as'=>'create',                           // route name
          'uses'=>'UsersController@post_register'))
          ->before('guest');// action
Route::get('users/login',                           // url
    array('as'=>'login',                            // route name
        'uses'=>'UsersController@get_login'));      // action
Route::post('users/login',                          // url
    array('as'=>'login_post',                       // route name
        'uses'=>'UsersController@post_login'));     // action
Route::get('users/secure',                      // url
    array('before' => 'roles:admin*employee','as'=>'secure',                       // route name
        'uses'=>'UsersController@get_secure'))
			->before('auth');
 Route::get('users/allusers',                      // url
    array('before' => 'roles:admin*manager','as'=>'allUsers',                       // route name
        'uses'=>'UsersController@get_users'))
            ->before('auth');
Route::get('users/manage',                      // url
    array('before' => 'roles:admin','as'=>'manage',                       // route name
        'uses'=>'UsersController@get_registrants'))
            ->before('auth');
Route::get('users/adminManage',                      // url
    array('before' => 'roles:admin','as'=>'adminManage',                       // route name
        'uses'=>'UsersController@get_adminRegistrants'))
            ->before('auth');
Route::get('users/delete/{id}', array('as'=>'delete_user',
 'uses'=>'UsersController@get_destroy'));           
Route::post('users/roleUpdate',                      // url
    array('before' => 'roles:admin','as'=>'roleUpdate',                       // route name
        'uses'=>'UsersController@post_registrants'))
            ->before('auth');            
Route::get('users/logout',                       // url
    array('as'=>'logout',                       // route name
        'uses'=>'UsersController@get_logout'));
Route::get('password/remind',                           // url
    array('as'=>'remind',                   // route name
        'uses'=>'RemindersController@getRemind'));
Route::post('password/remind',                           // url
    array('as'=>'remindPost',                   // route name
        'uses'=>'RemindersController@postRemind'));
Route::get('password/reset/{token}',                    // url
    array('as'=>'resetPwd',                   // route name
        'uses'=>'RemindersController@getReset'));
Route::post('password/reset/{token}',                           // url
    array('as'=>'resetPwdPost',                   // route name
        'uses'=>'RemindersController@postReset'));
Route::get('password/change', 
	array('as'=>'passwordChange', 
		'uses'=>'UsersController@get_change'))
		->before('auth'); 
Route::post('password/change', 
		array('as'=>'passwordPost', 
			'uses'=>'UsersController@post_change'))
				->before('auth');

