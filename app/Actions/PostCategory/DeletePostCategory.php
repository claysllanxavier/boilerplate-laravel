<?php

namespace App\Actions\PostCategory;

use App\Contracts\PostCategoryRepositoryInterface;

class DeletePostCategory
{

    protected $postCategoryRepository;

    public function __construct(
        PostCategoryRepositoryInterface $postCategoryRepository
    ) {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function execute(int $id): bool
    {
        $postCategory = $this->postCategoryRepository->delete($id);

        if (!$postCategory) abort(404);

        return $postCategory;
    }
}
