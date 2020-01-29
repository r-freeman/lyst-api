<?php

use App\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amazonUk = new Store();
        $amazonUk->name = "amazon";
        $amazonUk->region = "UK";
        $amazonUk->save();

        $amazonDe = new Store();
        $amazonDe->name = "amazon";
        $amazonDe->region = "DE";
        $amazonDe->save();

        $amazonFr = new Store();
        $amazonFr->name = "amazon";
        $amazonFr->region = "FR";
        $amazonFr->save();

        $amazonEs = new Store();
        $amazonEs->name = "amazon";
        $amazonEs->region = "ES";
        $amazonEs->save();

        $amazonIt = new Store();
        $amazonIt->name = "amazon";
        $amazonIt->region = "IT";
        $amazonIt->save();
    }
}
