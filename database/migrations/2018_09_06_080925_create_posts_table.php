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

            $table->increments('id');

            $table->unsignedInteger('category_id')->index();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('name');

            $table->text('content');

            $table->string('file')->nullable();

            $table->unique(["name", "category_id"]);

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
