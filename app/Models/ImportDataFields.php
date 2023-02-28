<?php
/**
 * Class Badge
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;
use Storage;
use Illuminate\Support\Facades\Crypt;

/**
 * Class Badge
 *
 */
class ImportDataFields extends Model
{

    public $table = 'import_data_extra_fields';
    protected $appends = 'value';

    protected $fillable = ['fields','type','import_data_id'];
    public function getValueAttribute()
    {
       
        return Crypt::decryptString( $this->fields);
    }


  
}