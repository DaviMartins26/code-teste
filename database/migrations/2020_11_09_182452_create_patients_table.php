<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id');
			$table->string('name')->nullable();
			$table->string('breed')->nullable();
			$table->enum('gender', [ 'M', 'F' ])->nullable();
			$table->date('birthdate')->nullable();
            $table->timestamps();
            //$table->string('image')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
