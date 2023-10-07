<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Secretary;

class SecretarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Secretary::factory(1)->create();
    }
}
