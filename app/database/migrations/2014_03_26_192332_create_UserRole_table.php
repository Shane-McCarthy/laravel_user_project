<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
{
    Schema::create(
        'userrole',
        function (Blueprint $table) {
            $table->unsignedInteger('userID');
            $table->unsignedInteger('roleID');
            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('roleID')->references('id')->on('role');
        });
}

public function down()
{
    Schema::drop('userrole');
}


}
