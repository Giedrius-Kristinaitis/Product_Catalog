<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ReviewRepositoryInterface
{
    /**
     * Gets all reviews by post id
     * @param int $post_id
     * @return Collection
     */
    public function getAllByPostId(int $post_id): Collection;
}