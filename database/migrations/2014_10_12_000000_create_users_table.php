<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password');
            $table->string('social_id')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('profile_picture')->nullable();
            $table->tinyInteger('social_type')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->integer('created_on');
            $table->integer('updated_on')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
