<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontMenusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('front_menus', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->boolean('active')->default(1);
      $table->string('name', 255);
      $table->string('url', 155)->nullable();
      $table->text('options');
      $table->integer('order')->nullable();
      $table->integer('parent_id')->nullable();
      $table->integer('group_id')->nullable();
      $table->string('menu_type', 55)->nullable();
      $table->integer('user_id');
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
    Schema::dropIfExists('front_menus');
  }
}
