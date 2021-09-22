<?php

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
        $this->call(categoryseeder::class);
        $this->call(publisherseeder::class);
        $this->call(authorseeder::class);
        $this->call(bookseeder::class);
        
    }
}
