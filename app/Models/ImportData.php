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
class ImportData extends Model
{

    public $table = 'import_data';
    protected $appends = 'name_value,instagram_name,facebook_name,twitter_name';
   

    protected $fillable = ['name','ig_username','twitter_username','facebook_username'];
    public function getNameValueAttribute()
    {
       
        return Crypt::decryptString( $this->name);
    }

    public function getInstagramNameAttribute()
    {
       
        return Crypt::decryptString( $this->ig_username);
    }

    public function getFacebookNameAttribute()
    {
       
        return Crypt::decryptString( $this->facebook_username);
    }

    public function getTwitterNameAttribute()
    {
       
        return Crypt::decryptString($this->twitter_username);
    }
  
}