<?php

namespace App\Actions\PostCategory;

use App\Contracts\PostCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreatePostCategory
{

    protected $postCategoryRepository;

    public function __construct(
        PostCategoryRepositoryInterface $postCategoryRepository
    ) {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function execute(array $attributes): Model
    {
        return $this->postCategoryRepository->create($attributes);
    }
}
