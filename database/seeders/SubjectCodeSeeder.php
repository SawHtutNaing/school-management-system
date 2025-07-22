<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubjectCode;

class SubjectCodeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [

            ['type' => 'CS'],
            ['type' => 'CT'],
            ['type' => 'CST'],
            ['type'=>'E'],

        ];

        foreach ($types as $type) {
            SubjectCode::create($type);
        }
    }
}
