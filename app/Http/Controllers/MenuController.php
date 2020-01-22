<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use Illuminate\Http\Request;
use App\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Cache;
class MenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MenuResource
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create($request->only('name','max_depth','max_children'));

        return new MenuResource($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return MenuResource
     */
    public function show($menu)
    {
        $menu_id = $menu;

        if (Cache::has("menu_$menu_id")) {
            $menu = Cache::pull("menu_$menu_id");
        }else{
            $menu = Menu::findOrFail($menu_id);
            Cache::add("menu_$menu_id", $menu, 10);
        }

        return new MenuResource($menu);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $menu
     * @return MenuResource
     */
    public function update(StoreMenuRequest $request, $menu)
    {
        $menu_id = $menu;
        $menu = Menu::findOrFail($menu_id);

        $menu->update($request->only('name','max_depth','max_children'));
        Cache::forget("menu_$menu_id");
        return new MenuResource($menu);
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
            $menu->delete();
            Cache::forget("menu_$menu_id");
        } catch (\Exception $e) {
        }

        return response()->json(null,204);
    }
}
