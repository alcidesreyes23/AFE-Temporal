<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;


    protected $fillable = [
        'product_name',
        'price',
        'barcode',
        'image',
        'supplier_id',
        'slug',
        'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('product_name')
            ->saveSlugsTo('slug');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
