<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class authors extends Model
{
    protected $fillable = ['product_id', 'description'];
    public function products()
    {
        return $this->belongsTo(products::class);
    }
}
