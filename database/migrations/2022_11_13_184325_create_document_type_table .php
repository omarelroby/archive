<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypeTable extends Migration {

	public function up()
	{
		Schema::create('document_type', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('name', 150);

		});
	}

	public function down()
	{
		Schema::drop('sub_category');
	}
}
