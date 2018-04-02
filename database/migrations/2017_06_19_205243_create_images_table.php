<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caption');
            $table->string('img_url');
            $table->string('img_thumb_url');
            $table->string('imagetable_type');
            $table->integer('imagetable_id');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('images');
    }
}
