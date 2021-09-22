<?php

use App\category;
use Illuminate\Database\Seeder;

class categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::create(["name"=>"علم الفلسفة والمنطق"]);
        category::create(["name"=>"العمل الحر"]);
        category::create(["name"=>"التسويق والمبيعات"]);
        category::create(["name"=>"التصميم"]);
        category::create(["name"=>"البرمجة"]);
        category::create(["name"=>"الديانة الإسلامية"]);
        category::create(["name"=>"تنمية بشرية"]);
        category::create(["name"=>"روايات"]);
        category::create(["name"=>"طب"]);
        category::create(["name"=>"تاريخ"]);
        
    }
}
