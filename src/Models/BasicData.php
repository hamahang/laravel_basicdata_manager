<?php

namespace ArtinCMS\LBDM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FileManager\FileManager
 *
 * @mixin \Eloquent
 */
class BasicData extends Model
{
    use SoftDeletes;
	protected $table = 'basicdata';
    public function Items()
    {
        return $this->hasMany('ArtinCMS\LBDM\Models\BasicDataValue','basicdata_id','id');
    }
}
