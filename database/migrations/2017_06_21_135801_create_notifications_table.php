<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('notificationtable_type'); //e.g. liked, created, logged in, etc
            $table->integer('notificationtable_id')->unsigned();
            $table->string('notificationtableitem_type'); //e.g. post, photo, etc
            $table->integer('notificationtableitem_id')->unsigned();
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
        //Schema::dropIfExists('notifications');
    }
}
