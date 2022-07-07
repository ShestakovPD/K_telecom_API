<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_name');
            $table->string('serial_mask');
            $table->timestamps();
        });

        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*$table->foreignId('id_equipment_type')->constrained()->onDelete('cascade');*/
            $table->unsignedBigInteger('id_equipment_type');
            $table->foreign('id_equipment_type')->references('id')->on('equipment_types')->onDelete('cascade');
            $table->string('serial_number');
            $table->string('note');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('equipment');
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropSoftDeletes(); //функционал мягкого удаления
        });
    }
};
