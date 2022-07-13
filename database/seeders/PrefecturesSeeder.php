<?php

namespace Database\Seeders;

use App\Models\Prefecture;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prefecture::truncate();

        DB::table('prefectures')->insert([
            'id' => 1,
            'name' => '北海道',
            'order_num' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '青森県',
            'order_num' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '岩手県',
            'order_num' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '宮城県',
            'order_num' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '秋田県',
            'order_num' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '山形県',
            'order_num' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '福島県',
            'order_num' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '茨城県',
            'order_num' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '栃木県',
            'order_num' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '群馬県',
            'order_num' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '埼玉県',
            'order_num' => 11,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '千葉県',
            'order_num' => 12,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'id' => 13,
            'name' => '東京都',
            'order_num' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '神奈川県',
            'order_num' => 14,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '新潟県',
            'order_num' => 15,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '富山県',
            'order_num' => 16,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '石川県',
            'order_num' => 17,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '福井県',
            'order_num' => 18,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '山梨県',
            'order_num' => 19,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '長野県',
            'order_num' => 20,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '岐阜県',
            'order_num' => 21,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '静岡県',
            'order_num' => 22,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '愛知県',
            'order_num' => 23,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '三重県',
            'order_num' => 24,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '滋賀県',
            'order_num' => 25,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '京都府',
            'order_num' => 26,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '大阪府',
            'order_num' => 27,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '兵庫県',
            'order_num' => 28,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '奈良県',
            'order_num' => 29,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '和歌山県',
            'order_num' => 30,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '鳥取県',
            'order_num' => 31,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '島根県',
            'order_num' => 32,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '岡山県',
            'order_num' => 33,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '広島県',
            'order_num' => 34,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '山口県',
            'order_num' => 35,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '徳島県',
            'order_num' => 36,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '香川県',
            'order_num' => 37,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '愛媛県',
            'order_num' => 38,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '高知県',
            'order_num' => 39,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '福岡県',
            'order_num' => 40,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '佐賀県',
            'order_num' => 41,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '長崎県',
            'order_num' => 42,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '熊本県',
            'order_num' => 43,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '大分県',
            'order_num' => 44,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '宮崎県',
            'order_num' => 45,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '鹿児島県',
            'order_num' => 46,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('prefectures')->insert([
            'name' => '沖縄県',
            'order_num' => 47,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
