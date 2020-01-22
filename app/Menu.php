<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name','max_depth','max_children'];

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function parentable()
    {
        return $this->morphTo();
    }
}
