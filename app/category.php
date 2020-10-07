<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name','slug'];

    public function products(){
        return $this->belongsToMany(product::class,'category_products');
    }
}
