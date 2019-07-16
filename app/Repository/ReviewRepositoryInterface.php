<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ReviewRepositoryInterface
{
    /**
     * Gets all reviews by product id
     * @param int $product_id
     * @return Collection
     */
    public function getAllByProductId(int $product_id): Collection;

    /**
     * Saves a review into the database
     *
     * @param array $data
     */
    public function save(array $data): void;
}