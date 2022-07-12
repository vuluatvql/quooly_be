<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $system = new Contact();
        $system->first_name = "first_name";
        $system->last_name = "last_name";
        $system->first_name_furigana = "first_name_furigana";
        $system->last_name_furigana = "last_name_furigana";
        $system->email = "email@gmail.com";
        $system->content = "Content";
        $system->save();

    }
}
