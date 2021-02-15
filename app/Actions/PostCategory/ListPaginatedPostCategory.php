<?php

namespace App\Actions\PostCategory;

use App\Contracts\PostCategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPaginatedPostCategory
{

    protected $postCategoryRepository;

    public function __construct(
        PostCategoryRepositoryInterface $postCategoryRepository
    ) {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function execute(): LengthAwarePaginator
    {
        return $this->postCategoryRepository->getPaginated(25, ['id', 'name']);
    }
}
