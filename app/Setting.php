<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'options';
    
    protected $fillable = ['key', 'title', 'value'];
}
