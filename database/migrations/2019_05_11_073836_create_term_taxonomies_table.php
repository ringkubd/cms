<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active');
            $table->string('name', 255);
            $table->string('slug')->index();
            $table->string('description', 455)->nullable();
            $table->integer('user_id');
            $table->integer("module_id")->nullable();
            $table->string('menugroup', 55)->nullable();
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
        Schema::dropIfExists('term_taxonomies');
    }
}
