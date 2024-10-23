<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->mediumText('image')->nullable();
            $table->string('language',30)->nullable();
            $table->tinyInteger('show_language')->default('0')->nullable();
            $table->string('theme',30)->nullable();
            $table->tinyInteger('show_theme')->default('0')->nullable();
            $table->rememberToken();
            $table->string('reset_token',100)->nullable();
            $table->tinyInteger('active')->default('0')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
};
