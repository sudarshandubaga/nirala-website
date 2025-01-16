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
        Schema::table('phases', function (Blueprint $table) {
            $table->string('image')->after('project_id')->nullable();

            $table->string('slug')->after('name')->nullable();
            $table->longText('overview')->after('project_id')->nullable();
            $table->string('location_image')->after('overview')->nullable();
            $table->longText('location_advantages')->after('location_image')->nullable();
            $table->longText('specification')->after('location_advantages')->nullable();
            $table->longText('price_list')->after('specification')->nullable();

            // $table->string('price_list_image')->after('price_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phases', function (Blueprint $table) {
            //
        });
    }
};
