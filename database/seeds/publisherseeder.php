<?php

use App\publisher;
use Illuminate\Database\Seeder;

class publisherseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        publisher::create(["name"=>"دار الحضارة للنشر والتوزيع"]);
        publisher::create(["name"=>"دار أرواد"]);
        publisher::create(["name"=>"دار الشروق"]);
        publisher::create(["name"=>"دار الفارابي"]);
        publisher::create(["name"=>"دار الجندي"]);
        publisher::create(["name"=>"دار الأهلية للنشر"]);
        publisher::create(["name"=>"دار الكتاب العربي"]);
        publisher::create(["name"=>"دار نهضة مصر للنشر والتوزيع"]);
        publisher::create(["name"=>"دار الفراشة"]);
        publisher::create(["name"=>"دار المعارف"]);
    }
}
