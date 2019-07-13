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
     * @return mixed
     */
    public function getRating(int $id)
    {
        return Product::where('id', $id)->first()->reviews()->avg('rating');
    }

    /**
     * Deletes a product with the given id
     *
     * @param int $id
     */
    public function delete(int $id): void
    {
        Product::destroy($id);
    }

    /**
     * Deletes multiple products
     *
     * @param array $ids
     */
    public function deleteMultiple(array $ids): void
    {
        Product::destroy($ids);
    }
}