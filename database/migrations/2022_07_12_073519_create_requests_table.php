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
        Schema::create('requests', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name', 255);
            $table->bigInteger('user_id')->comment('ユーザーID');
            $table->bigInteger('prefecture_id')->comment('都道府県ID');
            $table->string('city', 255)->nullable()->comment('市区都');
            $table->integer('price_lower')->comment('物件価格下限');
            $table->integer('price_upper')->comment('物件価格上限');
            $table->integer('revenue_yield')->comment('利回り');
            $table->integer('construction_year')->comment('築年数');
            $table->integer('walkrange')->comment('駅徒歩');
            $table->string('comment', 5000)->nullable()->comment('一言コメント');
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
        Schema::dropIfExists('requests');
    }
};
