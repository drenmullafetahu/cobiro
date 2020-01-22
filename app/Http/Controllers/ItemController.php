<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Item;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Support\Facades\Cache;
class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreItemRequest  $request
     * @return ItemResource
     */
    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->only(['name','menu_id','item_id']));

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $item
     * @return ItemResource
     */
    public function show($item)
    {

        $item_id = $item;

        if (Cache::has("items_$item_id")) {
            $item = Cache::pull("items_$item_id");
        }else{
            $item = Item::where('id',$item_id)
                ->with('children')
                ->get();
            Cache::add("items_$item_id", $item, 10);
        }

        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $item
     * @return ItemResource
     */
    public function update(StoreItemRequest $request, $item)
    {
        $item_id = $item;
        $item = Item::findOrFail($item);

        $item->update($request->only(['name','menu_id','item_id']));
        Cache::forget("items_$item_id");
        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($item)
    {
        $item_id = $item;
        $item = Item::findOrFail($item);
        try{
            $item->delete();
            Cache::forget("items_$item_id");
        }catch(\Exception $e){

        }
        return response()->json(null,204);
    }
}
