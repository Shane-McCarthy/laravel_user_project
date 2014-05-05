<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
{
    $passwordA = Hash::make('password');
    DB::table('users')->insert(array(
        'firstname'=>'James',
        'lastname'=>'Brown',
        'email'=>'jbrown@home.com',
        'password'=>$passwordA,
        'created_at'=>date('Y-m-d H:m:s'),
        'updated_at'=>date('Y-m-d H:m:s')
    ));
    DB::table('users')->insert(array(
        'firstname'=>'Jon',
        'lastname'=>'Sigardson',
        'email'=>'sigardson@home.com',
        'password'=>$passwordA,
        'created_at'=>date('Y-m-d H:m:s'),
        'updated_at'=>date('Y-m-d H:m:s')
    ));
    DB::table('users')->insert(array(
        'firstname'=>'Steve',
        'lastname'=>'Richards',
        'email'=>'ardson@home.com',
        'password'=>$passwordA,
        'created_at'=>date('Y-m-d H:m:s'),
        'updated_at'=>date('Y-m-d H:m:s')
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
