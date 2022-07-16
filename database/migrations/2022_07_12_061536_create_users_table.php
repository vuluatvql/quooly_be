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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->comment('ロールID');
            $table->string('first_name', 255)->comment('お名前（姓）');
            $table->string('last_name', 255)->comment('お名前（名）');
            $table->string('first_name_furigana', 255)->comment('ふりがな（姓）');
            $table->string('last_name_furigana', 255)->comment('ふりがな（名）');
            $table->string('email', 255)->comment('メールアドレス');
            $table->date('birthday')->comment('生年月日')->nullable();
            $table->string('password', 255)->comment('パスワード）');
            $table->string('phone_number', 255)->nullable()->comment('電話番号');
            $table->string('postcode', 255)->nullable()->comment('郵便番号');
            $table->bigInteger('prefecture_id')->nullable()->comment('都道府県ID）');
            $table->string('city', 255)->nullable()->comment('住所（市区町）');
            $table->string('address', 255)->nullable()->comment('住所（番地・建物名・部屋番号）');
            $table->string('reset_password_token', 255)->nullable();
            $table->dateTime('reset_password_token_expire')->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->datetime('last_login_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
