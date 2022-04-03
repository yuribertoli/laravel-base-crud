<?php

use App\Comic;
use Illuminate\Database\Seeder;

class ComicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('comics');

        foreach($data as $item){

            $comic = new Comic();
            
            $comic->title = $item['title'];
            $comic->description = $item['description'];
            $comic->thumb = $item['thumb'];
            $comic->price = $item['price'];
            $comic->series = $item['series'];
            $comic->sale_date = $item['sale_date'];
            $comic->type = $item['type'];

            $comic->save();
        }
    }
}
