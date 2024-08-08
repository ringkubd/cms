<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseStudyRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_study_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("is_active")->default(1);
            $table->integer("post_id")->index();
            $table->integer("round_id");
            $table->integer("subject_id");
            $table->integer("student_id");
            $table->integer("module_id");
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
        Schema::dropIfExists('case_study_relations');
    }
}
