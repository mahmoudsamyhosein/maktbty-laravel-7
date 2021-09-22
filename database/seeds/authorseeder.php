<?php

use App\author;
use Illuminate\Database\Seeder;

class authorseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        author::create(["name"=>'مصطفى محمود']);
        author::create(["name"=>'محمد بن إسماعيل البخاري']);
        author::create(["name"=>'ابراهيم الفقي']);
        author::create(["name"=>'حنان لاشين']);
        author::create(["name"=>'محمد بن صالح العثيمين']);
        author::create(["name"=>'محمد متولي الشعرواي']);
        author::create(["name"=>'اجاثا كريستي']);
        author::create(["name"=>'سارة رفان']);
        author::create(["name"=>'علي بن جابر الفيفي']);
        author::create(["name"=>'جلال الدين السيوطى']);
    }
}
