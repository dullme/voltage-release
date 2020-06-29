<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends BaseModel
{
    protected $fillable = [
        'company_id',
        'code',
        'name',
        'address',
        'total_quantity',
        'size_dc',
        'connector',
        'fuse',
        'junction_box_to_rack_1',
        'junction_box_to_rack_2',
        'layout_of_whip',
        'distance_between_poles',
        'end_of_extender',
        'row_head_to_cbx_1',
        'row_head_to_cbx_2',
        'module_to_module_extender',
        'remarks',
        'remark_list',
        'neg_color',
        'pos_color',
        'whip_quote_quantity',
        'typical_quote_quantity',
        'whip_buffer',
        'whip_to_be_half',
        'string_length_buffer',
        'specifications',
    ];

    protected $casts = [
        'remark_list' => 'array',
        'specifications' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function combinations()
    {
        return $this->belongsToMany(Combination::class);
    }
}
