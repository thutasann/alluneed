<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Products extends Model
{
    // use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'sub_category_id',
        'vendor_id',
        'name',
        'url',
        'small_description',
        'prod_image',
        'prod_image_1',
        'prod_image_2',
        'prod_image_3',
        'p_highlight_heading',
        'p_highlights',
        'p_description_heading',
        'p_description',
        'p_details_heading',
        'p_details',
        'sale_tag',
        'original_price',
        'offer_price',
        'quantity',
        'priority',
        'new_arrival',
        'featured_products',
        'popular_products',
        'offers_products',
        'status',
        'meta_title',
        'meta_description',
        'meta_keyword'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}
