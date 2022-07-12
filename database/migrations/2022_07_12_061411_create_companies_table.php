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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('企業名');
            $table->string('manager_name', 255)->comment('担当者名');
            $table->string('postal_code', 255)->comment('郵便番号');
            $table->string('prefecture_id', 255)->comment('都道府県ID');
            $table->string('address1', 255)->comment('市区町村');
            $table->string('address2', 255)->nullable()->comment('番地');
            $table->string('buiding_name', 255)->nullable()->comment('物件名、部屋番号');
            $table->string('tel', 255)->nullable()->comment('電話番号');
            $table->tinyInteger('status')->nullable()->default(0)->comment('ステータス（0:無効、1:有効）');
            $table->tinyInteger('plan_id')->nullable()->comment('プランID');
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
        Schema::dropIfExists('companies');
    }
};
