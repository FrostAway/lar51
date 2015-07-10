<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slides';
    
    protected $fillable = ['name', 'slug', 'slider_id', 'desc', 'image', 'order', 'params', 'layers'];
}
