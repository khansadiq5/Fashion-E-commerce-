<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'short_description',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function getPriceAttribute($value)
    {
        return '₹' . $value;
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
}