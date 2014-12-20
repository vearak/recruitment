<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateEmployerAgencyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employers', function($table){
			$table->integer('id');
			$table->string('company_name');
			$table->string('phone');
			$table->string('fax')->nullable();
			$table->tinyInteger('type');
			$table->tinyInteger('industry');
			$table->integer('num_employee')->nullable();
			$table->text('address');
			$table->string('location');
			$table->text('services')->nullable();
			$table->text('products')->nullable();
			$table->text('description')->nullable();
			$table->string('website')->nullable();
			$table->string('contact_person')->nullable();
			$table->string('contact_person_number')->nullable();
			$table->string('contact_person_email')->nullable();
			$table->string('map_latitude')->nullable();
			$table->string('map_longitude')->nullable();
			$table->timestamps();
			
			$table->primary('id');
		});
		
		Schema::create('job_posts', function($table){
			$table->increments('id');
			$table->text('title');
			$table->text('description');
			$table->integer('employer');
			$table->string('salary');
			$table->integer('gender');
			$table->integer('hiring');
			$table->integer('level');
			$table->integer('year_exp');
			$table->string('age')->nullable();
			$table->integer('term');
			$table->integer('function');
			$table->integer('industry');
			$table->integer('qualification');
			$table->datetime('publish_date');
			$table->datetime('closing_date');
			$table->integer('status')->default(0);
			$table->timestamps();
		});
		
		Schema::create('req_languages', function($table){
			$table->integer('job_id');
			$table->integer('lang');
			$table->integer('condition')->default(0);
			
			$table->primary(['job_id', 'lang']);
		});
		
		Schema::create('req_locations', function ($table){
			$table->integer('job_id');
			$table->integer('location');
			
			$table->primary(['job_id', 'location']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employers');
		Schema::drop('job_posts');
		Schema::drop('req_languages');
		Schema::drop('req_locations');
	}

}
