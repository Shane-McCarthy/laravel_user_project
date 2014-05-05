<?php


class Roles extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Role';
	protected $primaryKey = 'id'; 
	  public $timestamps = false;

	  protected $fillable = array ('id','name');
}

?>