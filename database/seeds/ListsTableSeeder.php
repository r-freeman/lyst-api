<?php

use App\ListModel;
use App\User;
use Illuminate\Database\Seeder;

class ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(2);

        // create unlisted list
        $unlisted = new ListModel();
        $unlisted->name = "unlisted";
        $unlisted->is_public = 0;
        $unlisted->user_id = $user->id;
        $unlisted->save();

        // create another list
        $firstList = new ListModel();
        $firstList->name = "Your First List";
        $firstList->is_public = 0;
        $firstList->user_id = $user->id;
        $firstList->save();
    }
}
