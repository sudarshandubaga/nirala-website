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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('father_or_husband_name')->nullable();
            $table->string('current_address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('occupation')->nullable();
            $table->string('nationality')->default('Indian');
            $table->string('vehicle_type')->nullable();
            $table->string('image')->nullable();
            $table->string('sign')->nullable();
            $table->json('records')->nullable();
            $table->string('related_to_directors')->default('no');
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('convicted')->default('no');
            $table->string('interviewed')->default('no');
            $table->string('expected_ctc')->nullable();
            $table->string('notice_period')->nullable();
            $table->json('references')->nullable();
            $table->json('professional_membership')->nullable();
            $table->json('employment_history')->nullable();
            $table->json('particulars')->nullable();
            $table->string('resume_file')->nullable();
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
        Schema::dropIfExists('applicants');
    }
};
