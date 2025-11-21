<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'status'
    ];


    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childrens(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }


    protected static function boot(){
        parent::boot();

        static::creating(function($category){
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
