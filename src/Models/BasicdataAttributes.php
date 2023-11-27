<?php

namespace Hamahang\LBDM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasicdataAttributes extends Model
{
    use softDeletes;
    protected $table = 'lbdm_basicdata_attributes';
    protected $fillable =
    [
        'basicdata_id',
        'title',
        'target_table',
        'target_id',
        'description',
        'created_by',
    ];
}

