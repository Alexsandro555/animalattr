<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('categories')->insert([
          'title' => 'Корневая',
          'url_key' => 'root',
          'sort' => 1,
          'description' => 'Корневая директория',
          'active' => true,
          'parent_id' => null
        ]);
        // $this->call("OthersTableSeeder");
    }
}
