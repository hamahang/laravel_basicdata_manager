<?php

namespace Hamahang\LBDM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasicdataValueAble extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'lbdm_basicdata_valueables';
    protected $fillable =
    [
        'basicdata_values_id',
        'target_id',
        'target_type',
        'val',

    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            if (is_null($query->order))
            {
                $query->order = self::where('basicdata_id', '=', $query->basicdata_id)->max('order') + 1;
            }
        });
    }



}

