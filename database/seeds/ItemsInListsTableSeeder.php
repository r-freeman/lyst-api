<?php

use App\Item;
use App\ListModel;
use Illuminate\Database\Seeder;

class ItemsInListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // attach seeded item to list
        $firstItem = Item::find(1);
        $firstItem->lists()->attach(ListModel::where('id', 2)->first());

        // attach seeded item to list
        $secondItem = Item::find(11);
        $secondItem->lists()->attach(ListModel::where('id', 2)->first());

        // attach seeded item to list
        $thirdItem = Item::find(21);
        $thirdItem->lists()->attach(ListModel::where('id', 2)->first());
    }
}
