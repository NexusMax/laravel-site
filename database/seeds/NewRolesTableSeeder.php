<?php

use Illuminate\Database\Seeder;
use App\Roles;


class NewRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'name' => 'Super Admin',
            'slug' => 'superadmin',
            'description' => 'Super Admin Role',
            'level' => 10,
        ]);
    }
}
