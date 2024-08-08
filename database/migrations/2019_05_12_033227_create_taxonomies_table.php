<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("active")->default(0);
            $table->string("name", 255);
            $table->string("slug")->index();
            $table->string("description", 400)->nullable();
            $table->integer("parent_id")->nullable();
            $table->string("picture", 255)->nullable();
            $table->string("term")->index();
            $table->string("module", 55)->nullable();
            $table->integer("user_id");
            $table->boolean("is_delete")->default(0);
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
        Schema::dropIfExists('taxonomies');
    }
}
