<?php

namespace App\Repository;

use App\Product;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Gets all products
     * @return Collection
     */
    public function all(): Collection
    {
        return Product::all();
    }

    /**
     * Creates a new product
     * @param array $data
     */
    public function create(array $data): void
    {
        Product::create($data);
    }

    /**
     * Gets product's rating
     * @param int $id
     * @return float
     */
    public function getRating(int $id): float
    {
        return Product::where('id', $id)->reviews()->avg('rating');
    }
}