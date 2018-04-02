<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('sms_user_name', 50)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->enum('gender', ['m', 'f']);
            $table->string('email', 50)->nullable();
            $table->string('phone_number', 13);
            $table->string('password')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->boolean('active')->default(0);
            $table->unique(array('email', 'company_id'));
            $table->unique(array('account_number', 'company_id'));
            $table->unique(array('phone_number', 'company_id'));
            $table->rememberToken();
            $table->timestamps();
        });

        
        /*create groups table*/
        /*Schema::defaultStringLength(191);
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('box', 50)->nullable();
            $table->string('phone_number', 13)->nullable();
            $table->string('email', 50)->nullable();
            $table->decimal('latitude', 13, 3)->nullable();
            $table->decimal('longitude', 13, 3)->nullable();
            $table->integer('company_id')->unsigned();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();           
            $table->timestamps();
        });*/


        // Create table for associating groups to users
        /*Schema::defaultStringLength(191);
        Schema::create('group_user', function (Blueprint $table) {
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'group_id']);
        });*/
        

        // Create companies table
        Schema::defaultStringLength(191);
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('sms_user_name', 50)->nullable();
            $table->string('box', 50)->nullable();
            $table->string('phone_number', 13)->nullable();
            $table->string('email', 50)->nullable();
            $table->decimal('latitude', 13, 3)->nullable();
            $table->decimal('longitude', 13, 3)->nullable(); 
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();           
            $table->timestamps();
        });

        Schema::defaultStringLength(191);
        Schema::create('mpesa_paybills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('paybill_number')->unsigned();
            $table->integer('company_branch_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();           
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        //Schema::dropIfExists('groups');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('mpesa_paybills');
        //Schema::dropIfExists('group_user');*/
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    

}
