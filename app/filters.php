<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (!Auth::check()) //check to see if user is authenticated 
	// Redirect user back to secure area with flash message 
	return Redirect::route ('login')
	-> with ('message', 'You must be logged in to view this page !!!'); 
});

Route::filter('roles', function($route, $request, $roles) {
     $id = '';
    if(Auth::check())
        $id = Auth::user()->id;

    $permissions =  explode('*', $roles);
    Log::info("has permissions " + User::isRolePermitted($permissions, $id));
    if(!Auth::check() || !User::isRolePermitted($permissions, $id) )
        return Redirect::to('users/login')
            ->with('message', 'Request not permitted.');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	    if (Auth::check())  // Check if user is authenticated
        // Redirect user back to secure area with flash message.
        return Redirect::route('secure')
            ->with('message', 'You are already logged in!');

});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/
Route::filter('csrf', function()
{
    if ( !isset($_SESSION['test'])
        && Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
