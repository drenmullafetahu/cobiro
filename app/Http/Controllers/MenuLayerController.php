<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\Cache;
class MenuLayerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return array
     */
    public function show($menu,$layer)
    {
        $menu_id = $menu;

        if (Cache::has("menu_layer_$menu_id")) {
            $menu = Cache::pull("menu_item_$menu_id");
        }else{
            $menu = Menu::where('id', $menu_id)
                ->with('items')->get();
            Cache::add("menu_item_$menu_id", $menu, 10);
        }


        $layerarray = [];
        if($layer > 1){

            foreach($menu[0]->items as $item){
                for ($i=0; $i < ($layer-1); $i++ ){

                    $layerarray[] = $item['children'];

                }

            }
            return $layerarray;
        }
        else{
            return $menu[0]->items;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu)
    {
        //
    }
}
