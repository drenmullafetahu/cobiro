<?php

namespace App\Http\Controllers;
use App\Menu;
use Illuminate\Support\Facades\Cache;
class MenuDepthController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  mixed $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($menu)
    {
        $menu_id = $menu;

        if (Cache::has("menu_depth_$menu_id")) {
            $menu = Cache::pull("menu_depth_$menu_id");
        }else{
            $menu = Menu::where('id', $menu)
                ->with(
                    ['items']
                )->get();
            Cache::add("menu_depth_$menu_id", $menu, 10);
        }

        $array = $menu->toArray();
        $i =0 ;
        $d = 0;

        while (!empty($array[0]['items'][$i])){
            $c = 0;
            while (!empty($array[0]['items'][$i]['children'][$c])){
                $c++;
                if($c > $d){
                    $d = $c;
                }
            }
            $i++;
        }



        return response()->json(['depth' => $d],200);
    }
}
