<?php
namespace ArtinCMS\LBDM\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FileManager\FileMimeType
 *
 * @mixin \Eloquent
 */
class BasicDataValue extends Model
{
    use SoftDeletes;
    protected $table = 'basicdata_values';

    public function parent()
    {
        return $this->belongsTo('ArtinCMS\LBDM\Models\BasicData','basicdata_id','id');
    }


}