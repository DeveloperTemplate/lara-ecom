<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'img',
        'status'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategory()
    {
        return $this->hasMany(ChildCategory::class, 'sub_category_id', 'id');
    }

}
