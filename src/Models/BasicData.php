<?php

namespace ArtinCMS\LBDM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basicdata extends Model
{
    use softDeletes;
    protected $table = 'lbdm_basicdata';
    protected $fillable =
    [
        'title',
        'comment',
        'inactive'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Basicdata\BasicdataValue', 'basicdata_id');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Basicdata\Basicdata', 'parent_id','id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Basicdata\Basicdata', 'parent_id','id')->with('items');
    }

    function attrs()
    {
        return $this->hasMany('App\Models\Basicdata\BasicdataAttributes', 'basicdata_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(config('laravel_basicdata_manager.lbdm_get_user_model_name'), 'created_by');
    }

    public function getCreatedAtJalaliAttribute()
    {
        return LBDM_Date_GtoJ($this->created_at, 'Y/m/d');
    }

    public function getItemSelect2Attribute(){
        return $this->items()->select('id','title as text')->get();
    }

}

