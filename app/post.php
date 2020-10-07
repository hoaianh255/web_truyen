<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable =['title','slug','image','especially','is_published','details'];
}
