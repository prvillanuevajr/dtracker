<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDiseasesSymptoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_symptoms', function (Blueprint $table) {
            $table->unsignedBigInteger('symptom_id');
            $table->unsignedBigInteger('disease_id');

            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('symptom_id')->references('id')->on('symptoms');
            $table->unique(['symptom_id', 'disease_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diseases_symptoms');
    }
}
