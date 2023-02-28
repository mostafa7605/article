<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    public $table = 'tags_article';

    protected $fillable = ['tag_id','article_id'];

    public function tags()
    {
        return $this->belongsTo(\App\Models\Tags::class, 'tag_id', 'id');
    }

}
