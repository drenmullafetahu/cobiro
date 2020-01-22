<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemChildRequest;
use App\Item;
use App\Http\Resources\ItemResource;
use Illuminate\Support\Facades\Cache;
use App\Menu;
class ItemChildrenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  mixed $item
     * @param  StoreItemChildRequest $request
     * @return ItemResource
     */
    public function store($item, StoreItemChildRequest $request)
    {
        $item = Item::findOrFail($item);

        $item_child = $item->children()->create($request->only(['name','item_id']));

        return new ItemResource($item_child);

    }

    /**
     * Display the specified resource.
     *
     * @param  mixed $item
     * @return ItemResource
     */
    public function show($item)
    {
        $item_id = $item;

        if (Cache::has("item_$item_id")) {
            $item = Cache::pull("item_$item_id");
        }else{
            $item = Menu::findOrFail($item_id);
            Cache::add("item_$item_id", $item, 10);
        }

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        $item_id = $item;
        $item = Item::findOrFail($item_id);
        Cache::forget("item_$item_id");
        $item->delete();
    }
}
