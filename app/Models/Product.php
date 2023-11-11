<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'name',
        'slug',
        'actual_price',
        'discount_price',
        'desc',
        'short_desc',
        'meta_title',
        'meta_desc',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class);
    }


    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

}
