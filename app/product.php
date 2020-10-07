<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class product extends Model
{
    use Commentable;
    protected $fillable = ['category_Id', 'name', 'slug', 'thumbnail', 'author', 'details', 'especially', 'is_published'];

    public  function chapters()
    {
        return $this->hasMany(chapter::class);
    }
    public function categories()
    {
        return $this->belongsToMany(category::class, 'category_products');
    }
    public function authors()
    {
        return $this->hasMany(authors::class, 'products_authors');
    }
}
