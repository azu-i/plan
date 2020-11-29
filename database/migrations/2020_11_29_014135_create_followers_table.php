<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->unsignedBigInteger('following_id')->comment('フォローしているユーザID');
            $table->unsignedBigInteger('followed_id')->comment('フォローされているユーザID');

            $table->foreign('following_id')->references('id')->on('users');
            $table->foreign('followed_id')->references('id')->on('users');

            $table->unique([
                'following_id',
                'followed_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
