<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration {

	public function up()
	{
		Schema::create('jobs', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name', 150);
			$table->string('description',150);
			$table->integer('administration_id')->unsigned();


		});
	}

	public function down()
	{
		Schema::drop('sub_category');
	}
}
