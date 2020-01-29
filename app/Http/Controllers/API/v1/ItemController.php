<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all()->load('store');

        return response()->json([
            "status" => "OK",
            "data" => $items
        ], 200);
    }

    public function show($id)
    {
        $item = Item::find($id);

        if ($item !== null) {
            $item->load('store');
            $status = "OK";
            $code = 200;
        } else {
            $status = "Not found";
            $code = 404;
        }

        return response()->json([
            "status" => $status,
            "data" => $item
        ], $code);
    }
}
