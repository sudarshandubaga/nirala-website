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
        Schema::create('phase_new_price_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->constrained()->onDelete('CASCADE');
            $table->string('title');
            $table->string('size');
            $table->string('price');
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
        Schema::dropIfExists('phase_new_price_lists');
    }
};
