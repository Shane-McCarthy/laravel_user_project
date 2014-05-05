<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'id'; 

	// This code allows mass assignment which is an unsecure way to create
    // data.  More will be discussed later for making it more secure.
    protected $fillable = array('lastname', 'firstname', 'email', 'password');

    public static $rules = array(
        'firstname'=>'required|alpha|min:2',
        'lastname'=>'required|alpha|min:2',
        'email'=>'required|email|unique:users',
        'password'=>'required|alpha_num|between:6,12|confirmed',
        'password_confirmation'=>'required|alpha_num|between:6,12'
    );
    public static $rules2 = array(
        
        'password'=>'required|alpha_num|between:6,12|confirmed',
        'password_confirmation'=>'required|alpha_num|between:6,12'
    );


    public static function validate($data) {
        return Validator::make($data, static::$rules);
    }
     public static function validatePass($data) {
        return Validator::make($data, static::$rules2);
    }



	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	    public function getAuthIdentifier() {
        return $this->id;
    }

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	static function getRoles($id) {
 //   $id   = Auth::user()->id;

    $roles = DB::table('UserRole')
        ->join('Role', 'UserRole.roleID', '=', 'Role.id')
        ->where('UserRole.userID', '=', $id)
        ->get(array('name'));
    return $roles;
}

public static function isRolePermitted($permissions, $id) {
    log::info('***&&&id = '.$id);
    $roles     = User::getRoles($id);
    foreach($roles as $role) {
        log::info("i am in parent loopy");
        foreach($permissions as $p){
            Log::info('roley ='.$p);
            if($p == $role->name) {
                return true;
            }
        }
    }
    return false;
}

public static function hasRole ($roleName){
	$id = Auth::user()->id; 
	$count = DB::table('UserRole')
	->join('Role','UserRole.roleID','=','Role.id')
	        ->where('UserRole.userID', '=', $id)
	->where('Role.name', '=', $roleName)
	->count(); 
	if ($count ==1)
		return true ; 
	return false;
}
public static function checkAdmin ($id){
		// $id = Auth::user()->id; 
   $userRole = UserRole::where('userID','=' ,$id)->first(); 
   if(isset($userRole->roleID)){
	$role = Roles::where('id',$userRole->roleID)->first(); 
    return $role->name; 
}

}
public static function countAdmin (){
		// $id = Auth::user()->id; 
   $userRole = UserRole::where('roleID',1)
   ->count(); 
	
    return $userRole; 

}

}