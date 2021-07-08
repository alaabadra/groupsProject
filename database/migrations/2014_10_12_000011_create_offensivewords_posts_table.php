<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffensivewordsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offensivewords_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offensiveword_id')->nullable();
            $table->foreign('offensiveword_id')->references('id')->on('offensivewords')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('offensivewords_posts');
    }
}
