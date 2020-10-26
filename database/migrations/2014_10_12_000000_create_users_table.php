<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('name')->comment('Nombre del rol de usuario');
    		$table->text('description');
    		$table->timestamps();
	    });
        Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('role_id')->default(\App\Role::STUDENT);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('name');
	        $table->string('last_name')->nullable();
	        $table->string('slug');
            $table->string('email')->unique();
            $table->string('password')->nullable();
	        $table->string('picture')->nullable();

	        $table->rememberToken();
	        $table->timestamps();
        });
	    Schema::create('user_social_accounts', function(Blueprint $table)
	    {
		    $table->increments('id');
		    $table->unsignedInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('provider');
		    $table->string('provider_uid');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
    {
		Schema::dropIfExists('roles');
			Schema::dropIfExists('users');
		Schema::dropIfExists('user_social_accounts');
    }
}
