<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubeSightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_sight', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('channel_id', 255)->index();
            $table->string('name', 255);
            $table->date('published_at');
            $table->json('access_token');
            $table->uuid('api_access_key')->index();
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
        Schema::dropIfExists('youtube_sight');
    }
}
