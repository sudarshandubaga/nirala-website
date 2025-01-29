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
        Schema::table('applicants', function (Blueprint $table) {
            $table->foreignId('career_post_id')->after('full_name')->nullable()->constrained()->onDelete('set null');
            $table->string('current_ctc')->after('interviewed')->nullable();
            // 
            $table->string('alt_mobile_no')->nullable()->after('phone_number');
            $table->string('permanent_address')->nullable()->after('current_address');
            $table->string('spouse_mobile')->nullable()->after('spouse_name');
            $table->string('spouse_occupation')->nullable()->after('spouse_mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            //
        });
    }
};
