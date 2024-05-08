<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'slug',
        'name',
        'description',
        'old_price',
        'sale_price',
        'thumb',
        'category_id',
        'status'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images():HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
