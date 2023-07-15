<?php

namespace App\Http\Services\Book;

use App\Http\Repositories\Book\BookIndexDTO;
use App\Http\Repositories\Book\BookRepository;
use App\Http\Repositories\Book\BookStoreDTO;
use App\Http\Repositories\Book\BookUpdateDTO;
use App\Http\Repositories\Book\Iterators\BookIterator;
use Illuminate\Support\Collection;

class BookServices
{

    public function __construct(
        protected BookRepository $bookRepository
    )
    {
    }

    public function store(BookStoreDTO $bookStoreDTO): BookIterator
    {
        $book_id = $this->bookRepository->store($bookStoreDTO);
        return $this->bookRepository->show($book_id);
    }

    public function show(int $id): BookIterator
    {
        return $this->bookRepository->show($id);

    }

    public function update(BookUpdateDTO $bookUpdateDTO): BookIterator
    {
        $this->bookRepository->update($bookUpdateDTO);
        return $this->bookRepository->show($bookUpdateDTO->getId());

    }

    public function destroy($id): int
    {
        return $this->bookRepository->destroy($id);
    }

    public function index(BookIndexDTO $bookIndexDTO): Collection
    {
        return $this->bookRepository->index($bookIndexDTO);

    }
}
