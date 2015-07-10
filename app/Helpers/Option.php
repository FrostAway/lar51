<?php

namespace App\Helpers;
use App\Setting;

class Option{
    public static function get_setting($key){
        $values = Setting::where('key', $key)->get(['value'])->first();
        if(empty($values)){
            return '';
        }  else {
            return $values->value;
        }
    }
}