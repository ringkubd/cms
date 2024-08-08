<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVtpAutoNoticesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('vtp_auto_notices', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->boolean('active')->default(1);
      $table->text('notice_title');
      $table->text('notice_slug');
      $table->longText('notice_details');
      $table->string('notice_type');
      $table->integer('user_id');
      $table->integer('updated_by')->nullable();
      $table->boolean('is_delete')->default(0);
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
    Schema::dropIfExists('vtp_auto_notices');
  }
}
