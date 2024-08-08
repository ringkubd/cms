<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("active")->default(0);
            $table->boolean("is_delete")->default(0);
            $table->string("name");
            $table->string("father_name")->nullable();
            $table->string("mother_name")->nullable();
            $table->text("address")->nullable();
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->integer("module_id");
            $table->integer("round_id");
            $table->integer("subject_id");
            $table->integer("position_id");
            $table->integer("company_id")->nullable();
            $table->integer("user_id");
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
        Schema::dropIfExists('students');
    }
}
