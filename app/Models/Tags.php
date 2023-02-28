<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public $table = 'tags';

    protected $fillable = ['tag'];

    public function articles()
    {

     return $this->belongsToMany(\App\Models\ArticleTag::class, 'tags_article', 'article_id','tag_id');
     }
}
