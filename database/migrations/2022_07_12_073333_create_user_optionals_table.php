<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_optionals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('ユーザーID');
            $table->integer('jobs_type')->nullable()->comment('職業');
            $table->integer('company_industry_type')->nullable()->comment('業種');
            $table->integer('rent_income')->nullable()->default(0)->comment('家賃収入');
            $table->integer('annual_income')->nullable()->default(0)->comment('世帯年収（家賃収入込む）');
            $table->integer('user_income')->nullable()->default(0)->comment('自己資金');
            $table->integer('property_building')->nullable()->comment('保有物件(ー棟)');
            $table->integer('property_division')->nullable()->comment('保有物件(区分)');
            $table->integer('property_kodate_chintai')->nullable()->comment('保有物件(戸建賃貸)');
            $table->tinyInteger('mail_magazine_flag')->default(1)->nullable()->comment('会員メルマガ');
            $table->tinyInteger('request_noti_flag')->default(1)->nullable()->comment('新着物件お知らせ');
            $table->tinyInteger('favorite_noti_flag')->default(1)->nullable()->comment('お気に入り物件メール通知');
            $table->tinyInteger('seminar_noti_flag')->default(1)->nullable()->comment('セミナーメール通知');
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
        Schema::dropIfExists('user_optionals');
    }
};
