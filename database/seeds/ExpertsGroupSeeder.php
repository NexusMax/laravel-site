<?php

use Illuminate\Database\Seeder;
use App\ExpertsGroup;

class ExpertsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Диетология',
                'alias' => 'nutritionist',
            ],
            [
                'name' => 'Фитнес',
                'alias' => 'fitness',
            ],
            [
                'name' => 'Психология',
                'alias' => 'psychologist',
            ],
            [
                'name' => 'Здоровье',
                'alias' => 'physical-therapist',
            ],
        ];
        foreach($categories as $key){
            ExpertsGroup::create([
                'name' => $key['name'],
                'alias' => $key['alias'],
                'meta_title' => $key['name'],
                'meta_desc' => $key['name'],
                'active' => 1,
            ]);
        }
    }
}
