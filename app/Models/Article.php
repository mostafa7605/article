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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Storage;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

/**
 * Class Badge
 *
 */
class Article extends Model implements Viewable
{

    use InteractsWithViews;


    public $table = 'articles';

    protected $fillable = ['author', 'title', 'description', 'image', 'content', 'purchase_type', 'category_id', 'url', 'cost', 'user_id', 'show', 'approved', 'file_name', 'file_type', 'file_size', 'original_content'];

    protected $appends = ['bookmarked'];

    public function bookmarks()
    {
        return $this->hasMany(\App\Models\Bookmark::class);
    }


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }



    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    public function article_additional_fields()
    {

        return $this->belongsToMany(\App\Models\AdditionalField::class, 'additional_articles', 'article_id', 'additional_field_id')->withPivot('value')->withTimestamps();
    }


    public function tagged_people()
    {

        return $this->belongsToMany(\App\Models\User::class, 'tagged_people', 'article_id', 'user_id')->distinct();
    }

    public function tags()
    {

        return $this->belongsToMany(\App\Models\Tags::class, 'tags_article', 'article_id', 'tag_id');
    }

    public function getBookmarkedAttribute()
    {
        if ((auth('api')->user())) {

            if (in_array($this->id, auth('api')->user()->bookmark_article->pluck('article_id')->toArray())) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function purchased()
    {
        return $this->belongsToMany(\App\Models\User::class, 'purchased_articles', 'article_id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
}
