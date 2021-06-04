<?php

use App\Models\Verdict;
use Illuminate\Database\Seeder;

class VerdictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verdictList = [
            [
                'id'   => 1,
                'description' => 'In Queue',
            ],
            [
                'id'   => 2,
                'description' => 'Running',
            ],
            [
                'id'   => 3,
                'description' => 'Accepted',
            ],
            [
                'id'   => 4,
                'description' => 'Wrong Answer',
            ],
            [
                'id'   => 5,
                'description' => 'Time Limit Exceeded',
            ],
            [
                'id'   => 6,
                'description' => 'Compilation Error',
            ],
            [
                'id'   => 7,
                'description' => 'Runtime Error',
            ],
            [
                'id'   => 8,
                'description' => 'Memory Limit Exceeded',
            ],
            [
                'id'   => 9,
                'description' => 'Exec Format Error',
            ],
            [
                'id'   => 10,
                'description' => 'Output Limit Exceeded',
            ],
            [
                'id'   => 11,
                'description' => 'Language Restricted',
            ],
            [
                'id'   => 12,
                'description' => 'Internal Error',
            ],

        ];
        foreach ($verdictList as $key => $value) {
            Verdict::create($value);
        }
    }
}
