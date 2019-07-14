<?php

namespace App\Http\Controllers;

use App\Repository\ProductRepositoryInterface;
use App\Repository\ReviewRepositoryInterface;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @var ReviewRepositoryInterface
     */
    private $review_repository;

    /**
     * @var ProductRepositoryInterface
     */
    private $product_repository;

    /**
     * ReviewController constructor.
     * @param ReviewRepositoryInterface $review_repository
     * @param ProductRepositoryInterface $product_repository
     */
    public function __construct(ReviewRepositoryInterface $review_repository, ProductRepositoryInterface $product_repository)
    {
        $this->review_repository = $review_repository;
        $this->product_repository = $product_repository;
    }

    /**
     * Stores a review in the database
     *
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $validated_data = $request->validate([
            'reviewer' => 'bail|required',
            'review' => 'bail|required',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|integer'
        ]);

        if ($this->product_repository->existsById($validated_data['product_id']))
        {
            $this->review_repository->save($validated_data);
        }
        else
        {
            abort(400);
        }
    }
}
