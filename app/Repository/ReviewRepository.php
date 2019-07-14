<?php

namespace App\Repository;

use App\Review;
use Illuminate\Support\Collection;

class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * Gets all reviews by product id
     * @param int $product_id
     * @return Collection
     */
    public function getAllByProductId(int $product_id): Collection
    {
        return Review::where('product_id', $product_id)->get();
    }

    /**
     * Saves a review into the database
     *
     * @param array $data
     */
    public function save(array $data): void
    {
        Review::create($data);
    }
}