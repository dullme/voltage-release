<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combination extends BaseModel
{

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
