<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    public function GetColor()
    {
        return $this->belongsTo(color::class, 'color_id');
    }

    public function GetProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function GetSize()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
