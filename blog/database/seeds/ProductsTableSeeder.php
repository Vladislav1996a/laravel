<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<11;$i++)
           \Illuminate\Support\Facades\DB::table('products')->insert([
                'title' => 'Product 1'. $i,
                'price' => rand(50,500),
                'description' => 'Lorem ipsum — классический текст-«рыба». Является искажённым отрывком из философского трактата Марка Туллия Цицерона «О пределах добра и зла», написанного в 45 году до н. э. на латинском языке, обнаружение сходства атрибутируется Ричарду МакКлинтоку. Википедия',
            ]);
    }
}
