<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
{
    DB::table('role')->insert(array(
        'name'=>'admin'
    ));
    
    DB::table('role')->insert(array(
        'name'=>'employee'
    ));
    DB::table('role')->insert(array(
        'name'=>'manager'
    ));
}

public function down()
{
    //
}


}
