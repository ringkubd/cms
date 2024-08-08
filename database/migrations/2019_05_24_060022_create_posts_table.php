<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("post_title");
            $table->text("post_title_bn")->nullable();
            $table->string("post_slug")->unique();
            $table->longText("post_content")->nullable();
            $table->longText("post_content_bn")->nullable();
            $table->text("post_excerpt")->nullable();
            $table->text("post_excerpt_bn")->nullable();
            $table->string("post_status", 45);
            $table->timestamp("schedule_time")->nullable();
            $table->string("post_type", 55);
            $table->string("post_format", 55)->default("standard");
            $table->string("upload_type", 45)->nullable();
            $table->string("post_thumb")->nullable();
            $table->boolean("thumb_status")->default(1);
            $table->string("comments_status")->nullable();
            $table->string("attachment_status")->nullable();
            $table->string("option_status")->nullable();
            $table->boolean("is_delete")->default(0);
            $table->integer("user_id");
            $table->index(['post_status', 'post_type']);
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
        Schema::dropIfExists('posts');
    }
}
