<?php

namespace App\Http\Services\Category;

use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryServices
{

    public function __construct(
        protected CategoryRepository $categoryRepository
    )
    {
    }

    public function store(string $name): CategoryIterator
    {
        $categoryId = $this->categoryRepository->store($name);
        return $this->categoryRepository->show($categoryId);
    }

    public function show(int $id): CategoryIterator
    {
        return $this->categoryRepository->show($id);

    }

    public function update(int $id, string $name): CategoryIterator
    {
        $this->categoryRepository->update($id, $name);
        return $this->categoryRepository->show($id);

    }

    public function destroy($id): int
    {
        return $this->categoryRepository->destroy($id);
    }

    public function index(): Collection
    {
        return $this->categoryRepository->index();

    }
}
