<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contributor;
use App\Models\FundCollection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        FundCollection::factory(10)
            ->has(Contributor::factory(10), 'contributors')
            ->create();

    }
}
