<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForbiddenwordsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forbiddenwords_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forbiddenword_id')->nullable();
            $table->foreign('forbiddenword_id')->references('id')->on('forbiddenwords')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('forbiddenwords_posts');
    }
}
