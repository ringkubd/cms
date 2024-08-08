<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(1);
            $table->string('name')->index();
            $table->string('icon', 255)->nullable();
            $table->string('route_uri')->index();
            $table->string('method', 55)->index();
            $table->integer('parent_id')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('visibility')->default(1);
            $table->string('description', 400)->nullable();
            $table->boolean('is_delete')->default(0);
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
        Schema::dropIfExists('admin_menus');
    }
}
