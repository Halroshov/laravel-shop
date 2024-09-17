<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'brand_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // 添加这个方法来定义与 ProductImage 的关联
    public function productImage()
    {
        return $this->hasOne(ProductImage::class);
    }
}