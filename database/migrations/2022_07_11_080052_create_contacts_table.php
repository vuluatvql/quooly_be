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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255)->comment('お名前（姓）');
            $table->string('last_name', 255)->comment('お名前（名）');
            $table->string('first_name_furigana', 255)->comment('ふりがな（姓）');
            $table->string('last_name_furigana', 255)->comment('ふりがな（名）');
            $table->string('email', 255)->comment('メールアドレス');
            $table->text('content')->comment('問い合わせ内容');
            $table->bigInteger('user_id')->nullable()->comment('ユーザーID');
            $table->bigInteger('business_user_id')->nullable()->comment('不動産ユーザーID');
            $table->tinyInteger('contact_type')->default(1)->nullable()->comment('1: ユーザー、2: 不動産ユーザーID');
            $table->tinyInteger('status')->default(0)->nullable()->comment('0: 未対応、1: 対応済み');
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
        Schema::dropIfExists('contacts');
    }
};
