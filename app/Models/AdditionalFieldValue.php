<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;
use Storage;

/**
 * Class Badge
 *
 */
class AdditionalFieldValue extends Model
{
    public $table = 'additional_articles';
    protected $fillable = [
         'article_id',
         'additional_field_id',
         'value'
    ];
    public function additionalfield()
    {
        return $this->belongsTo(\App\Models\AdditionalField::class, 'additional_field_id', 'id');
    }
}
