<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration {

	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name', 150);
			$table->string('file_number',150);
			$table->integer('parties_id');
            $table->integer('document_type_id');

            $table->date('import_date');
            $table->date('export_date');


		});
	}

	public function down()
	{
		Schema::drop('sub_category');
	}
}
