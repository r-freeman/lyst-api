<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\ListModel;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $lists = ListModel::all()->load('items')->load('user');

        return response()->json([
            "status" => "OK",
            "data" => $lists
        ], 200);
    }

    public function show($id)
    {
        $list = ListModel::find($id);

        if ($list !== null) {
            $list->load('items')->load('user');
            $status = "OK";
            $code = 200;
        } else {
            $status = "Not found";
            $code = 404;
        }

        return response()->json([
            "status" => $status,
            "data" => $list
        ], $code);
    }
}
