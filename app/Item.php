<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','menu_id','item_id'];

    protected $with = ['children'];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function children(){
        return $this->hasMany(Item::class);
    }
}
