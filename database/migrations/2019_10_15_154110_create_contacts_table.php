<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contacts', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->string('phone', 20);
      $table->string('email', 155);
      $table->text('message');
      $table->string('ip_address');
      $table->boolean('viewed')->default(0);
      $table->boolean('delete')->default(0);
      $table->integer('viewed_by')->nullable();
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
    Schema::dropIfExists('contacts');
  }
}
