<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends BaseModel
{

    public function bracket()
    {
        return $this->belongsTo(Bracket::class);
    }

    public function panels()
    {
        return $this->belongsToMany(SolarPanel::class);
    }
}
