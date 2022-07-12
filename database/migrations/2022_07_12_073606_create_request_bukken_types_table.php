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
        Schema::create('request_bukken_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id')->comment('ニーズID');
            $table->tinyInteger('bukken_type')->comment('物件種類（ENUM）');
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
        Schema::dropIfExists('request_bukken_types');
    }
};
