<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends BaseModel
{

    public function specifications()
    {
        return $this->belongsToMany(Specification::class);
    }

    public function component()
    {
        return $this->hasMany(ItemComponent::class);
    }
}
