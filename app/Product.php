<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use QCod\ImageUp\HasImageUploads;

class Product extends Model
{

    use HasImageUploads;

    /**
     * Gets the product's reviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany('App\Review');
    }
}
