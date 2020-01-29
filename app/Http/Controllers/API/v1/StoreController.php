<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        return response()->json([
            "status" => "OK",
            "data" => $stores
        ], 200);
    }

    public function show($id)
    {
        $store = Store::find($id);

        if ($store !== null) {
            $status = "OK";
            $code = 200;
        } else {
            $status = "Not found";
            $code = 404;
        }

        return response()->json([
            "status" => $status,
            "data" => $store
        ], $code);
    }
}
