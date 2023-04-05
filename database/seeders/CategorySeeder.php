<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\Lang;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lIds = Lang::pluck('id')->toArray();
        $cL = count($lIds);

        for($x = 0; $x < 4; $x++){
            Category::factory()->count(5)->create()->each(
                function($category) use ($lIds, $cL){
                    for($i = 0; $i < rand(1 , $cL); $i++){
                        $lang = CategoryLang::factory()->make();
                        $lang->lang_id = $lIds[$i];
                        $category->langs()->save($lang);
                    }
                }
            );
        }
    }
}
