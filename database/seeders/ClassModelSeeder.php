<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['name' => 'First year', 'term' => 'First term', 'section' => 'A'],
            ['name' => 'First year', 'term' => 'First term', 'section' => 'B'],
            ['name' => 'First year', 'term' => 'Second term', 'section' => 'A'],
            ['name' => 'First year', 'term' => 'Second term', 'section' => 'B'],

            ['name' => 'Second year', 'term' => 'First term', 'section' => 'A'],
            ['name' => 'Second year', 'term' => 'First term', 'section' => 'B'],
            ['name' => 'Second year', 'term' => 'Second term', 'section' => 'A'],
            ['name' => 'Second year', 'term' => 'Second term', 'section' => 'B'],

            ['name' => 'Third year', 'term' => 'First term', 'section' => 'A'],
            ['name' => 'Third year', 'term' => 'First term', 'section' => 'B'],
            ['name' => 'Third year', 'term' => 'Second term', 'section' => 'A'],
            ['name' => 'Third year', 'term' => 'Second term', 'section' => 'B'],

            ['name' => 'Fourth year', 'term' => 'First term', 'section' => 'A'],
            ['name' => 'Fourth year', 'term' => 'First term', 'section' => 'B'],
            ['name' => 'Fourth year', 'term' => 'Second term', 'section' => 'A'],
            ['name' => 'Fourth year', 'term' => 'Second term', 'section' => 'B'],

            ['name' => 'Final year', 'term' => 'First term', 'section' => 'A'],
            ['name' => 'Final year', 'term' => 'First term', 'section' => 'B'],
            ['name' => 'Final year', 'term' => 'Second term', 'section' => 'A'],
            ['name' => 'Final year', 'term' => 'Second term', 'section' => 'B'],

        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }
    }
}

