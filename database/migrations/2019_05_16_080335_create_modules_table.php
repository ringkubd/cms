<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('modules', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->boolean('active')->default(0);
      $table->string('name');
      $table->string('slug')->index();
      $table->string('menuGroup', 55)->nullable();
      $table->string('picture', 255)->nullable();
      $table->date('start_form')->nullable();
      $table->longText('description')->nullable();
      $table->integer('user_id');
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
    Schema::dropIfExists('modules');
  }
}
