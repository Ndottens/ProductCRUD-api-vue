<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->createCategories();
    }

    public function createCategories()
    {
        DB::table('categories')->insert([
            'title' => CategoryType::MONITORS,
            'description' => 'test',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'title' => CategoryType::TELEVISION,
            'description' => 'test',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'title' => CategoryType::PHONES,
            'description' => 'test',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
