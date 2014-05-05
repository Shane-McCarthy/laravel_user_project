<?php

class UsersController extends BaseController {
    protected $layout = "layouts.main";

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    public $restful = true;
    public function get_register(){
        return View::make('users.register')        // Define location of users file.
            ->with('title', 'User Registration');  // Define title variable.
    }

    public function post_register(){
         sleep(2); 
        $validation = User::validate(Input::all()); // Validate user with model.

                                                    // Show error if model is invalid or 
                                                    // if CSRF token is invalid.
        if($validation->fails() || Session::token() != Input::get('_token')) {
            return Redirect::to('users/register')
                ->with('message', 'The following errors occurred')
                ->withErrors($validation)->withInput();
        }
        else {                                      // Create a new user in database.
            User::create(array(
                'lastname'=>Input::get('lastname'),
                'firstname'=>Input::get('firstname'),
                'email'=>Input::get('email'),
                'password'=>Hash::make(Input::get('password'))// Enrypted and salted pwd.
            ));
            $id= User::where('email',Input::get('email'))->first();  
            UserRole::create(array('userID'=>$id->id,
                                    'roleID'=> 2)); 
            return Redirect::to('users/register')
                // Create flash message that is only available for one new request
                ->with('message', 'This account has been created successfully.');
        }
    }
   public function get_login() {
        // $data = array ('username'=> 'phong@doctorphong.com', 
        //     'firstname'=> 'Shane',
        //     'from' => 'phong@doctorphong.com', 
        //     'password' => 'Phillip10',
        //     'from_name'=> 'Shane'); 
        // Mail::send('emails.welcome', 
        //     $data , function($message)use ($data){
        //         $message 
        //         ->to ('mikehawkisitchy@gmail.com', 'Rolf Weinstien')
        //         -> subject ('Welcome to My Laravel site !'); 
         //   }); 
    return View::make('users.login')    // Define location of users file.
        ->with('title', 'User Login');  // Define title variable.
}
public function post_login() {
    sleep(2); 
    // get user inputs
    $userName    = Input::get('email');
    $pwd         =      Input::get('password');
    $credentials = array('email' => $userName, 'password' => $pwd);
   
    // login successful so redirect to users/secure
    if (Auth::attempt($credentials)) {
       $user= User::where('email','=',$userName)->firstOrFail();  

         Session::put('userId', $user->id); 

        return Redirect::to('users/secure')->with('message', 'You are now logged in!');
    }
    // login not successful so return to login with flash message
    else {
        return Redirect::to('users/login')
            ->with('message', 'Your username/password combination was incorrect')
            ->withInput();
    }
}
// Secure area controller
public function get_secure() {
    if(Session::get('userId')==2){
        Log::info("has permissions " );
    }
    return View::make('users.secure')       // Define location of users file.
        ->with('title', 'Secure Area'); // Define title variable.
}
public function get_users() {
    return View::make('users.users')       // Define location of users file.
        ->with('title', 'All Users Area')
        ->with ('users',User::all())
        ->with('users',User::orderBy('lastname')->paginate(2)); // Define title variable.
}
public function get_registrants() {
   

    return View::make('users.manage')       // Define location of users file.
        ->with('title', 'Manage Users ')
        ->with ('users', User::all())
        ->with('roles',Roles::all())
         ->with('users',User::orderBy('lastname')->paginate(2));// Define title variable.
}
public function get_adminRegistrants() {
   

    return View::make('users.adminManage')       // Define location of users file.
        ->with('title', 'Manage Users ')
        ->with ('users', User::all())
        ->with('roles',Roles::all());// Define title variable.
}

public function post_registrants(){
    $role = Input::get('roles'); 
    $userId = Input::get('id'); 
    $userRole = UserRole::where('userID',$userId)->first(); 
    $userRole->roleID = $role; 
    $userRole->save(); 
    return View::make('users.manage')
    ->with ('title','Success')
     ->with ('users', User::all())
        ->with('roles',Roles::all())
          ->with('users',User::orderBy('lastname')->paginate(2)); // Define title variable.; 
}
 public  function get_destroy($id) {
    //die($id); 
       
        UserRole::find($id)->delete(); 
        User::find($id )->delete();
        return Redirect::to('users/manage')->with('message', 'The user has been deleted');
    }
// logout
public function get_logout() {
    Auth::logout();
    Session::flush();
    return Redirect::to('users/login')
          ->with('message', 'Your are now logged out!');
}
public function get_change(){
 return View::make('password.change')        // Define location of users file.
            ->with('title', 'User Settings');  // Define title variable.
}
public function post_change(){
     sleep(2); 
  $validation = User::validatePass(Input::only(
             'password', 'password_confirmation')); // Validate user with model.

                                                    // Show error if model is invalid or 
                                                    // if CSRF token is invalid.
        if($validation->fails() || Session::token() != Input::get('_token')) {
            return Redirect::to('password/change')
                ->with('message', 'The following errors occurred')
                ->withErrors($validation)->withInput();
            }else {                                      // Create a new user in database.
           $passChange =  User::find(Session::get('userId')); 
           $passChange->password = Hash::make(Input::get('password'));        // Enrypted and salted pwd.
            
            return Redirect::to('users/secure')
                // Create flash message that is only available for one new request
                ->with('message', 'Your Password has been changed successfully.');
        }
}
}
?>
