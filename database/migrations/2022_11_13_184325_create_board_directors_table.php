<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardDirectorsTable extends Migration {

	public function up()
	{
		Schema::create('board_directors', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name', 150);
			$table->string('email', 255);
			$table->string('password', 255);
			$table->string('signature', 255);
            $table->integer('job_id');
			$table->integer('file_id');
			$table->integer('position');

		});
	}

	public function down()
	{
		Schema::drop('sub_category');
	}
}
