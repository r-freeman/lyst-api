<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Item;
use App\ListModel;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // retrieve users items with lists and store relations
        $items = Item::with(['lists', 'store'])
            ->whereHas('lists', function ($q) {
                $q->where('user_id', '=', Auth::id());
            })->get();

        return response()->json([
            "status" => "OK",
            "data" => $items
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'required|string',
            'item_code' => 'required|string',
            'price' => 'nullable|numeric',
            'url' => 'required|string',
            'store_id' => 'required|integer|exists:stores,id',
            'list_id' => 'integer|exists:lists,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $validator->errors()
            ], 422);
        }

        $item = new Item();
        $item->title = $request->input('title');
        $item->image = $request->input('image');
        $item->item_code = $request->input('item_code');
        $item->price = $request->input('price');
        $item->url = $request->input('url');
        $item->store_id = $request->input('store_id');
        $listId = $request->input('list_id');
        $item->save();

        if ($listId) {
            // retrieve existing list
            $list = Auth::user()->lists()->where('id', $listId)->get();
            $item->lists()->attach($list);
        } else {
            // list id wasn't provided, attach item to unlisted
            $unlisted = Auth::user()->lists()
                ->where('name', 'unlisted')
                ->get();

            $item->lists()->attach($unlisted);
        }

        return response()->json([
            "status" => "OK",
            "data" => $item
        ]);
    }

    public function show($id)
    {
        $item = Item::find($id);

        if ($item !== null) {
            // load lists and store relations
            $item->load('lists')->load('store');
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'list_id' => 'required|integer|exists:lists,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $validator->errors()
            ], 422);
        }

        $item = Item::find($id);
        $list = ListModel::find($request->input('list_id'));

        if ($item !== null) {
            // retrieve the item lists
            $itemLists = $item->lists()->get();

            // detach the item from its existing lists
            foreach ($itemLists as $_list) {
                $item->lists()->detach($_list);
            }

            // attach the item to the new lsit
            $item->lists()->attach($list);

            // load the lists and store relations
            $item->load('lists')->load('store');

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

    public function destroy($id)
    {
        $item = Item::find($id);

        if ($item === null) {
            $status = "Item not found";
            $code = 404;
        } else {
            $itemLists = $item->lists()->get();

            // first detach the item from any lists
            foreach ($itemLists as $list) {
                $item->lists()->detach($list);
            }

            // delete the item
            $item->delete();

            $status = "OK";
            $code = 200;
        }

        return response()->json(
            [
                "status" => $status,
                "data" => $item
            ], $code
        );
    }
}
