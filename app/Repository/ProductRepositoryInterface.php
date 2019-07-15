<?php

namespace App\Repository;

use App\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * Gets all products
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Gets a page of products
     *
     * @param int $size
     * @return LengthAwarePaginator
     */
    public function page(int $size): LengthAwarePaginator;

    /**
     * Gets the product with the specified id
     *
     * @param $id
     * @return Product
     */
    public function getById($id): Product;

    /**
     * Creates a new product
     * @param array $data
     */
    public function create(array $data): void;

    /**
     * Updates product
     *
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data): void;

    /**
     * Gets product's rating
     * @param int $id
     * @return mixed
     */
    public function getRating(int $id);

    /**
     * Deletes a product with the given id
     *
     * @param int $id
     */
    public function delete(int $id): void;

    /**
     * Deletes multiple products
     *
     * @param array $ids
     */
    public function deleteMultiple(array $ids): void;

    /**
     * Checks if the product with the specified id exists
     *
     * @param int $id
     * @return bool
     */
    public function existsById(int $id): bool;
}