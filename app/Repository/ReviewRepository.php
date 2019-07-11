<?php

namespace App\Repository;

use App\Review;
use Illuminate\Support\Collection;

class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * Gets all reviews by post id
     * @param int $post_id
     * @return Collection
     */
    public function getAllByPostId(int $post_id): Collection
    {
        return Review::where('post_id', $post_id)->get();
    }
}