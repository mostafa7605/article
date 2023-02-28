<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rssData extends Model
{
    public $table = 'rss_data';

    protected $fillable = ['rss_id','data','match'];
    
    public function rssData()
    {
        return $this->belongsTo(\App\Models\Rss::class);
    }
}
