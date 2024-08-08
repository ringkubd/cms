<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("active")->default(0);
            $table->string("name");
            $table->text("description")->nullable();
            $table->timestamp("start_time")->nullable();
            $table->timestamp("end_time")->nullable();
            $table->boolean("is_delete")->default(0);
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
        Schema::dropIfExists('rounds');
    }
}
