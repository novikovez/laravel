<?php

namespace App\Http\Repositories\Category;

use App\Http\Repositories\Category\Iterators\CategoriesBooksIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;

class CategoriesIteratorDTO
{
    public function __construct(
        protected CategoryIterator $categoryIterator,
        protected CategoriesBooksIterator $categoriesBooksIterator
    )
    {
    }

    /**
     * @return CategoryIterator
     */
    public function getCategoryIterator(): CategoryIterator
    {
        return $this->categoryIterator;
    }

    /**
     * @return CategoriesBooksIterator
     */
    public function getCategoriesBooksIterator(): CategoriesBooksIterator
    {
        return $this->categoriesBooksIterator;
    }

}
