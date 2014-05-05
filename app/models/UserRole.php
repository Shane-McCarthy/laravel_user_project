<?php


class UserRole extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'UserRole';
	protected $primaryKey = 'userID'; 
	  public $timestamps = false;

	  protected $fillable = array ('userID','roleID');
}

?>