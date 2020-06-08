<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends BaseModel
{

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
