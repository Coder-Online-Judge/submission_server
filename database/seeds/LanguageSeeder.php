<?php

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languageList = [
            [
                'id'   => 1,
                'name' => 'C',
                'argument' => 'C',
            ],
            [
                'id'   => 2,
                'name' => 'C++',
                'argument' => 'CPP',
            ],
            [
                'id'   => 3,
                'name' => 'C++11',
                'argument' => 'CPP11',
            ],
            [
                'id'   => 4,
                'name' => 'C++14',
                'argument' => 'CPP14',
            ],
            [
                'id'   => 5,
                'name' => 'Java',
                'argument' => 'JAVA',
            ],
        ];
        foreach ($languageList as $key => $value) {
        	Language::create($value);
        }
    }
}
