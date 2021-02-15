<?php

namespace App\Actions\PostCategory;

use App\Contracts\PostCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FindOnePostCategory
{

    protected $postCategoryRepository;

    public function __construct(
        PostCategoryRepositoryInterface $postCategoryRepository
    ) {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function execute(int $id): Model
    {
        $postCategory = $this->postCategoryRepository->findOne($id);

        if (!$postCategory) abort(404);

        return $postCategory;
    }
}
