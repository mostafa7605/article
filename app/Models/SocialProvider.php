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

/**
 * Class Badge
 *
 */
class SocialProvider extends Model
{


    public $table = 'social_profiles';

    protected $fillable = ['user_id','provider_type','provider_user_id','provider_user_image','provider_user_name'];





}
