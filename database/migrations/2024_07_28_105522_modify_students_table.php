<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('profile_link')->after('phone')->nullable();
            $table->string('expertise')->after('profile_link')->nullable();
            $table->string('job_type')->after('expertise')->nullable();
            $table->tinyInteger('is_success_stories')->after('job_type')->default(0);
            $table->string('profile_image')->after('is_success_stories')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('profile_link');
            $table->dropColumn('expertise');
            $table->dropColumn('job_type');
            $table->dropColumn('is_success_stories');
            $table->dropColumn('profile_image');
        });
    }
}
