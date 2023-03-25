<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFBoardsTable extends Migration {

	public function up()
	{
		Schema::create('files_board_of_directors', function(Blueprint $table) {
			$table->bigIncrements('id');
            $table->integer('file_id');
            $table->integer('board_direct_id');
            $table->integer('status')->default('0');
			$table->timestamps();;

		});
	}

	public function down()
	{
		Schema::drop('files_board_of_directors');
	}
}
