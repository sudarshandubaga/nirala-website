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
        Schema::table('construction_updates', function (Blueprint $table) {
            // $table->dropForeign(['flat_id']);
            $table->dropColumn('flat_id');
            // $table->foreignId('tower_id')->after('flat_id')->nullable()->constrained()->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construction_updates', function (Blueprint $table) {
            //
        });
    }
};
