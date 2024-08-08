<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->string("title_bn")->nullable();
            $table->text("description")->nullable();
            $table->text("description_bn")->nullable();
            $table->string("upload_type", 55)->nullable();
            $table->string("picture")->nullable();
            $table->boolean("home_page")->default(0);
            $table->string("status");
            $table->timestamp("schedule_time")->nullable();
            $table->timestamp("start_time")->nullable();
            $table->timestamp("end_time")->nullable();
            $table->boolean("is_delete")->default(0);
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
        Schema::dropIfExists('advertisements');
    }
}
