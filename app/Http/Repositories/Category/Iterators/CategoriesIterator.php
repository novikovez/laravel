<?php

namespace App\Http\Repositories\Category\Iterators;

use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Category\CategoriesIteratorDTO;
use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class CategoriesIterator implements IteratorAggregate
{
    protected array $data = [];

    /**
     * @throws \Exception
     */
    public function __construct(Collection $collection)
    {
        $collection = $collection->groupBy('category_id');
        foreach ($collection as $item) {
            $dto = new CategoriesIteratorDTO(
                new CategoryIterator($item->unique('category_id')[0]),
                new CategoriesBooksIterator($item)
            );

            $this->data[] = $dto;
        }
    }

    public function add(CategoryIterator $categoryIterator): void
    {
        $this->data[] = $categoryIterator;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

}
