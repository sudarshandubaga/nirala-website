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
        Schema::table('career_posts', function (Blueprint $table) {
            $table->string("department")->after('slug');
            $table->integer("total_posts")->after('department');
            $table->string("location")->after('total_posts');
            $table->string("qualification")->after('location');
            $table->string("min_exp")->after('qualification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('career_posts', function (Blueprint $table) {
            //
        });
    }
};
