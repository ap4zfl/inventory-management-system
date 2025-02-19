<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'cat_name',
        'cat_slug',
        'cat_image',
    ];
    use HasFactory;
}
