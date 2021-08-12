<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atrribute extends Model
{
    use HasFactory, SoftDeletes;

    public function Products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getColor()
    {
        return $this->belongsTo(color::class, 'color_id');
    }
    public function getSize()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
