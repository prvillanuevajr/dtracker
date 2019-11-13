<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDiagnoses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->double('height_m', '10', '2')->nullable();
            $table->double('height_cm', '10', '2')->nullable();
            $table->double('height_in', '10', '2')->nullable();
            $table->string('height_ft_in')->nullable();

            $table->double('weight_kg', '10', '2')->nullable();
            $table->double('weight_lb', '10', '2')->nullable();

            $table->double('waist', '10', '2')->nullable();
            $table->double('hip', '10', '2')->nullable();

            $table->string('bmi_risk')->nullable();
            $table->string('bmi_status')->nullable();
            $table->double('bmi_value', 10, 2)->nullable();
            $table->double('bmi_prime', 10, 2)->nullable();

            $table->double('bmr_value', 10, 2)->nullable();

            $table->string('ideal_weight')->nullable();
            $table->double('ponderal_index')->nullable();
            $table->double('surface_area')->nullable();

            $table->string('whr_status')->nullable();
            $table->double('whr_value', 10, 2)->nullable();

            $table->string('whtr_status')->nullable();
            $table->double('whtr_value', 10, 2)->nullable();

            $table->unsignedBigInteger('disease_id');
            $table->foreign('disease_id')->references('id')->on('diseases');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}
