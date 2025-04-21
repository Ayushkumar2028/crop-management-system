<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('crops', function (Blueprint $table) {
            $table->string('soil_type')->nullable();
            $table->string('irrigation_type')->nullable();
            $table->decimal('expected_yield', 10, 2)->nullable();
            $table->decimal('actual_yield', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('crops', function (Blueprint $table) {
            $table->dropColumn(['soil_type', 'irrigation_type', 'expected_yield', 'actual_yield']);
        });
    }
};