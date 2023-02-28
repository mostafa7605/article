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


class ImageSlider extends Model
{

    public $table = 'images_sliders';

    protected $fillable = ['image', 'order', 'deeb_link', 'description', 'title'];
}
