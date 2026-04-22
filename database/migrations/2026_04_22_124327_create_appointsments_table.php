<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointsmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID do Dono
            $table->unsignedBigInteger('patient_id'); // ID do Pet
            $table->unsignedBigInteger('vet_id')->nullable(); // ID do Veterinário (pode começar vazio)
            $table->dateTime('date');
            $table->text('notes')->nullable(); // Observações do Vet
            $table->enum('status', ['pending', 'finalized'])->default('pending');
            $table->timestamps();

            // Chaves estrangeiras para integridade do banco
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('vet_id')->references('id')->on('users')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointsments');
    }
}
