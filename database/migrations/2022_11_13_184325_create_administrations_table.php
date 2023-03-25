<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationsTable extends Migration {

	public function up()
	{
		Schema::create('administrations', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name', 150);
			$table->string('description', 255);

		});
	}

	public function down()
	{
		Schema::drop('sub_category');
	}
}
