<?php

namespace Database\Seeders;

use App\Jobs\CreateUsersJob;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run(): void
    {
        $batch = [];
        for ($i = 0; $i < 500000; $i++) {
            $batch[] = [
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
            ];

            if (count($batch) == 1000) {
                CreateUsersJob::dispatch($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            CreateUsersJob::dispatch($batch);
        }

    }

}
