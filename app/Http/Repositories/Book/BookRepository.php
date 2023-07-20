<?php

namespace App\Http\Repositories\Book;

use App\Http\Repositories\Book\Iterators\BookIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository
{

    public function index(BookIndexDTO $bookIndexDTO): Collection
    {

        $query = DB::table('books');
        $query->select([
            "books.id",
            "books.name",
            "year",
            "lang",
            "pages",
            "books.created_at",
            "category_id",
            "categories.name as category_name",
        ])
            ->join('categories', 'categories.id', '=', 'books.category_id');

        $query->whereBetween('books.created_at', [$bookIndexDTO->getStartDate(), $bookIndexDTO->getEndDate()]);
        // lang
        $query->when($bookIndexDTO->getLang() !== null, function ($q) use ($bookIndexDTO) {
            return $q->where('lang', '=', $bookIndexDTO->getLang());
        });
        // year
        $query->when($bookIndexDTO->getYear() !== null, function ($q) use ($bookIndexDTO) {
            return $q->where('year', '=', $bookIndexDTO->getYear());
        });
        $query->when($bookIndexDTO->getLastId() !== null, function ($q) use ($bookIndexDTO) {
            return $q->where('books.id', '>', $bookIndexDTO->getLastId())->limit(100);
        });


        $booksData = collect($query->limit(100000)->get());
        return $booksData->map(function ($bookData) {
            return new BookIterator($bookData);
        });


    }


    public function store(BookStoreDTO $bookStoreDTO): int
    {
        return DB::table('books')
            ->insertGetId([
                "name" => $bookStoreDTO->getName(),
                "year" => $bookStoreDTO->getYear(),
                "lang" => $bookStoreDTO->getLang(),
                "pages" => $bookStoreDTO->getPages(),
                "category_id" => $bookStoreDTO->getCategoryId(),
                "created_at" => NOW()
            ]);
    }

    public function show(int $id): BookIterator
    {
        return new BookIterator(DB::table('books')
            ->select([
                    "books.id",
                    "books.name",
                    "year",
                    "lang",
                    "pages",
                    "books.created_at",
                    "category_id",
                    "categories.name as category_name",
                ]
            )
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->where('books.id', '=', $id)
            ->first());
    }

    public function update(BookUpdateDTO $bookUpdateDTO): int
    {
        return DB::table('books')
            ->where('id', '=', $bookUpdateDTO->getId())
            ->update([
                "name" => $bookUpdateDTO->getName(),
                "year" => $bookUpdateDTO->getYear(),
                "lang" => $bookUpdateDTO->getLang(),
                "pages" => $bookUpdateDTO->getPages(),
            ]);
    }

    public function destroy($id): int
    {
        return DB::table('books')->delete($id);
    }

    public function getAllBooks()
    {
//        $da = DB::table('books')
//            ->select([
//                "books.id as bookId",
//                "books.name",
//                "year",
//                "lang",
//                "pages",
//                "books.created_at",
//                "category_id",
//                "categories.name as category_name",
//            ])
//            ->join('categories', 'categories.id', '=', 'books.category_id')
//            ->chunkById(100, function (Collection $books) {
//                foreach($books as $book) {
//                    return collect($book);
//
//                }
//            }, 'books.id', 'bookId');
//        return $da;
        $query = DB::table('books');
        $query->select(
                [
                    "books.id",
                    "books.name",
                    "year",
                    "lang",
                    "pages",
                    "books.created_at",
                    "category_id",
                    "categories.name as category_name",
                ]
            )
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->where('year', '2011')
            ->chunkById(10000, function ($books) use (&$processedUsers) {
                foreach ($books as $book) {
                    $processedUsers[] = new BookIterator($book);
                }
            }, 'books.id', 'id');
        return $processedUsers;
    }

}
