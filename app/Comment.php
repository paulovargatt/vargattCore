<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['author_name','body','author_email','author_url','post_id'];

   public function post()
   {
       return $this->belongsTo(Post::class);
   }
}
