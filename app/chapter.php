<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chapter extends Model
{
    protected $fillable = ['product_id','chapter','name','slug'];

    public function products(){
        return $this->belongsTo(product::class);
    }
    public function galleries(){
        return$this->hasMany(gallerychap::class);
    }
}
