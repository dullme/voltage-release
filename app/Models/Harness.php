<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harness extends BaseModel
{
    public function component()
    {
        return $this->hasMany(HarnessComponent::class);
    }
}
