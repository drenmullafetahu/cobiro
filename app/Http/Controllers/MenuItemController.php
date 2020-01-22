<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MenuItemResource;
use App\Http\Requests\StoreMenuItemRequest;
use App\Menu;
use App\Http\Resources\MenuItemCollection;
use Illuminate\Support\Facades\Cache;
class MenuItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MenuItemResource
     */
    public function store($menu,StoreMenuItemRequest $request)
    {
        $menu = Menu::findOrFail($menu);

        $menuItems = $menu->items()->create($request->only('name'));

        return new MenuItemResource($menuItems);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return MenuItemCollection
     */
    public function show($menu)
    {
        $menu_id = $menu;

        if (Cache::has("menu_item_$menu_id")) {
            $menu = Cache::pull("menu_item_$menu_id");
        }else{
            $menu = Menu::findOrFail($menu);
            Cache::add("menu_item_$menu_id", $menu, 10);
        }

        return new MenuItemCollection($menu->items);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu)
    {
        $menu_id = $menu;
        $menu = Menu::findOrFail($menu_id);
        try {
            $menu->items->delete();
            Cache::forget("menu_item_$menu_id");
        } catch (\Exception $e) {
        }

        return response()->json(null,204);
    }
}
