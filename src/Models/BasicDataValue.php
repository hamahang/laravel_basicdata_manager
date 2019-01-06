<?php

namespace ArtinCMS\LBDM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasicdataValue extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'lbdm_basicdata_values';
    protected $fillable =
        [
            'parent_id',
            'title',
            'value',
            'comment',
            'inactive'
        ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query)
        {
            if ($query->order == null)
            {
                $query->order = self::where('basicdata_id','=',$query->basicdata_id)->max('order')+1;
            }
        });
    }
    public function attrs()
    {
        return $this->belongsToMany('App\Models\Basicdata\BasicdataAttributes', 'basicdata_attributes_values', 'basicdata_value_id', 'basicdata_attribute_id');//-- ->where('hamahang_basicdata_attributes.basicdata_id', $this->parent_id)--}}
    }

    public function basicdata()
    {
        return $this->belongsTo('App\Models\Basicdata\Basicdata', 'basicdata_id');
    }

    public function getBasicdatasAttributesAttribute()
    {
        return $this->basicdata->attrs;
    }

    public function created_by()
    {
        return $this->belongsTo(config('laravel_basicdata_manager.lbdm_get_user_model_name'), 'created_by');
    }

    public function getCreatedAtJalaliAttribute()
    {
        return LBDM_Date_GtoJ($this->created_at, 'Y/m/d');
    }

    public function getPreRequiredAttribute()
    {
        if(isset($this->value))
        {
            $value = $this->value ;
            if (isset($value->proccess_id))
            {
                $proccess_id = $value->proccess_id ;
                $process = SysProcess::find($proccess_id);;
                if(isset($process->pre_required))
                {
                    $func_name = $process->pre_required ;
                    $res = $func_name() ;
                }
                else
                {
                    $res = false ;
                }
            }
            else
            {
                $res = 'link' ;
            }
        }
        else
        {
            $res = false ;
        }
        return $res;
    }

}

