<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * Gets all products
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Creates a new product
     * @param array $data
     */
    public function create(array $data): void;

    /**
     * Gets product's rating
     * @param int $id
     * @return mixed
     */
    public function getRating(int $id);
}