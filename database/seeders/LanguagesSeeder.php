<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('languages')->count() == 0) {
            $languages = [
                'en', 'es', 'fr', 'de', 'zh', 'ja', 'ru', 'it', 'pt', 'nl',
                'ko', 'hr', 'hi', 'bn', 'tr', 'vi', 'pl', 'fa', 'sv', 'el'
            ];
        
            foreach ($languages as $code) {
                DB::table('languages')->insert([
                    'name' => $code,
                    'active' => false
                ]);
            }
        }
    }
}
