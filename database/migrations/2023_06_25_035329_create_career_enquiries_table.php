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
        Schema::create('career_enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_post_id')->constrained()->onDelete('CASCADE');
            $table->string("name");
            $table->enum("gender", ["Male", "Female", "Other"])->name("Male");
            $table->string("email");
            $table->string("phone");
            $table->string("address");
            $table->string("experience")->nullable();
            $table->string("current_salary")->nullable();
            $table->string("expected_salary")->nullable();
            $table->string("resume")->nullable();
            $table->string("previous_company_name")->nullable();
            $table->longText("remarks")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('career_enquiries');
    }
};
