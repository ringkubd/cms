<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVtpNoticeTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vtp_notice_tracker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(0);
            $table->integer('post_id');
            $table->string('vtp_round');
            $table->string('notice_type');
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
        Schema::dropIfExists('vtp_notice_tracker');
    }
}
