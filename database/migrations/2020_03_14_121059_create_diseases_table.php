<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->boolean('heart');
            $table->string('heart_description')->nullable();
            $table->boolean('osteoporosis');
            $table->string('osteoporosis_description')->nullable();
            $table->boolean('liver');
            $table->string('liver_description')->nullable();
            $table->boolean('cancer');
            $table->string('cancer_description')->nullable();
            $table->boolean('kidney');
            $table->string('kidney_description')->nullable();
            $table->boolean('hiv');
            $table->string('hiv_description')->nullable();
            $table->boolean('lung');
            $table->string('lung_description')->nullable();
            $table->string('hepatitis');
            $table->string('hepatitis_description')->nullable();
            $table->boolean('diabetes');
            $table->string('diabetes_description')->nullable();
            $table->boolean('circulatory');
            $table->string('circulatory_description')->nullable();
            $table->string('others_description')->nullable();
            $table->unsignedBigInteger('records_id');
            $table->timestamps();

            $table->foreign('records_id')->references('id')->on('records')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
