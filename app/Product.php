<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use QCod\ImageUp\HasImageUploads;

class Product extends Model
{

    use HasImageUploads;

    /**
     * Model fields that store the uploaded image's url
     *
     * @var array
     */
    protected static $imageFields = [
        'image'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'enabled', 'sku', 'base_price', 'discount'
    ];

    // any other than image file type for upload
    protected static $fileFields = [
        // make sure non-image files don't get uploaded
        'image' => [
            'auto_upload' => false,
            'rules' => 'mimes:png,jpg,jpeg'
        ]
    ];

    /**
     * Gets the product's reviews
     *
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany('App\Review');
    }
}
