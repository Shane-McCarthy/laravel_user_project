<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
{

    DB::table('UserRole')->insert(array(
        'userID'=>1,
        'roleID'=>1
    ));
    DB::table('UserRole')->insert(array(
        'userID'=>2,
        'roleID'=>2
    ));
     DB::table('UserRole')->insert(array(
        'userID'=>3,
        'roleID'=>3
    ));
}

/**
    * Reverse the migrations.
    *
    * @return void
    */
public function down()
{
    //
}


}
