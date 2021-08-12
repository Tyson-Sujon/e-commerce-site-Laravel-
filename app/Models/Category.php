<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getSubcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
    public function getProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
