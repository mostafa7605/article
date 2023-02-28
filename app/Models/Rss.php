<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rss extends Model
{
    public $table = 'rss';

    protected $fillable = ['link','category_id','name','publish','image','timer','date'];
    
    
    
    public function rssData()
    {
        return $this->hasMany(\App\Models\rssData::class);
    }
}
