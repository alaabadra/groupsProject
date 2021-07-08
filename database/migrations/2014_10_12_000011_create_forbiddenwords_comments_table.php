<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForbiddenwordsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forbiddenwords_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forbiddenword_id')->nullable();
            $table->foreign('forbiddenword_id')->references('id')->on('forbiddenwords')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->foreign('comment_id')->references('id')->on('comments')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('forbiddenwords_comments');
    }
}
