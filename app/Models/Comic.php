<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comic';

    public function category_multiple()
    {
        return  $this->belongsToMany(Category_multiple::class, 'category_multiple', 'comic_id', 'category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_multiple', 'comic_id', 'category_id');
    }
}
