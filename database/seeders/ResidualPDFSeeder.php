<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResidualPDFSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program = 'database/tables/programs.sql';
        DB::unprepared(file_get_contents($program));
        $this->command->info('Programs table seeded!');
    }
}
