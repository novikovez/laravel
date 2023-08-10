<?php

namespace App\Http\Repositories\Book;

use App\Http\Repositories\Book\Iterators\BookIterator;
use App\Http\Repositories\Book\Iterators\BooksIterator;
use App\Models\Book;
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
            return $q->where('books.id', '>', $bookIndexDTO->getLastId());
        });

        return collect($query->limit(100)->get());
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

    public function updateLang(): string
    {
        DB::table('books')
            ->where('lang', '=', 'de')
            ->chunkById(500, function (Collection $users) {
                foreach ($users as $user) {
                    DB::table('books')
                        ->where('id', $user->id)
                        ->update(['lang' => 'ua']);
                }
            });
        return json_encode('Language Updated');
    }

    public function indexModel(): Collection
    {
        return Book::query()
            ->with('author', 'category')
            ->orderBy('books.id', 'DESC')
            ->limit(5000)
            ->get();
    }

    /**
     * @throws \Exception
     */
    public function showIterator(): BooksIterator
    {
        $one = DB::table('books')
            ->select([
                'books.id',
            ])
            ->limit(5000)
            ->orderBy('books.id', 'DESC')
            ->get();

        $result = DB::table('books')
            ->whereIn('books.id', $one->pluck('id'))
            ->select([
                'books.id as book_id',
                'books.name as book_name',
                'books.year as book_year',
                'books.lang as book_lang',
                'books.pages as book_pages',
                'authors.id as author_id',
                'authors.author as author_name',
            ])
            ->join('author_book', 'book_id', '=', 'books.id')
            ->join('authors', 'authors.id', '=', 'author_book.author_id')
            ->orderBy('books.id', 'DESC')
            ->get();

        return new BooksIterator($result);
    }
}
