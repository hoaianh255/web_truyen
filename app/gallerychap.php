<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gallerychap extends Model
{
    protected $fillable = ['chapter_id','name'];
    public function chapters(){
        return $this->belongsTo(chapter::class);
    }
}
