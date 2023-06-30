<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BrandSeeder::class);
        $this->call(WmiSeeder::class);
        $this->call(WebCrawlerSeeder::class);
        $this->call(ResidualPDFSeeder::class);
        $this->call(UserSeeder::class);
    }
}
