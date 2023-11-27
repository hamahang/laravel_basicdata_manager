<?php

namespace Hamahang\LBDM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasicdataAttributesValues extends Model
{
    use softDeletes;
    protected $table = 'lbdm_basicdata_attributes_values';
    protected $fillable =
    [
        'basicdata_value_id',
        'basicdata_attribute_id',
        'value',
        'created_by',
    ];
}

