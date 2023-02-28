<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCodes extends Model
{
    public $table = 'phone_codes';

    protected $fillable = ['phone','sms_code'];
    
   
}
