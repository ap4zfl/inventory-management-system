<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'product_cat',
        'price',
        'old_price',
        'status',
        'stock',
        'image',
        'gallery',
        'excerpt',
        'descriptions',
        'hot',
        'popular',
        'bestselling',
        'justarrived',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
