<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('crop_name');
            $table->date('sowing_date');
            $table->decimal('cultivation_area', 10, 2);
            $table->enum('health_status', ['good', 'average', 'poor']);
            $table->enum('growth_stage', ['seedling', 'vegetative', 'flowering', 'harvesting']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crops');
    }
};