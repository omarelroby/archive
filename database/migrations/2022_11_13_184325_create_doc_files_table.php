<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocFilesTable extends Migration {

	public function up()
	{
		Schema::create('document_files', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('file_name');
            $table->integer('file_id');

		});
	}

	public function down()
	{
		Schema::drop('document_files');
	}
}
