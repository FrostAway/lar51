<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillabel = ['post_title', 'slug', 'image_url', 'post_excerpt', 'post_content', 'post_status', 'author_id', 'post_type', 'comment_status', 'comment_count'];
    
    public function cats(){
        return $this->belongsToMany('App\Category');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
