<?php

namespace App\Actions\PostCategory;

use App\Contracts\PostCategoryRepositoryInterface;

class UpdatePostCategory
{

    protected $postCategoryRepository;

    public function __construct(
        PostCategoryRepositoryInterface $postCategoryRepository
    ) {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function execute(int $id, array $attributes): bool
    {
        $postCategory = $this->postCategoryRepository->update($id, $attributes);

        if (!$postCategory) abort(404);

        return $postCategory;
    }
}
