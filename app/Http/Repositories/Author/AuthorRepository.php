<?php

namespace App\Http\Repositories\Author;

use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AuthorRepository
{

    public function indexModel(): Collection
    {

        return Author::query()
            ->with('book')
            ->orderBy('authors.id', 'DESC')
            ->limit(300)
            ->get();

    }

    /**
     * @throws \Exception
     */
    public function showIterator(): AuthorsIterator
    {


        $one = DB::table('authors')
            ->select([
                'authors.id',
            ])
            ->limit(300)
            ->orderBy('authors.id', 'DESC')
            ->get();

        $result = DB::table('authors')
            ->whereIn('authors.id', $one->pluck('id'))
            ->select([
                'authors.id as author_id',
                'authors.author as author_name',
                'books.id as book_id',
                'books.name as book_name',
                'books.year as book_year',
                'books.lang as book_lang',
                'books.pages as book_pages',
            ])
            ->join('author_book', 'author_id', '=', 'authors.id')
            ->join('books', 'books.id', '=', 'author_book.book_id')
            ->orderBy('authors.id', 'DESC')
            ->get();

//        $result = DB::table('authors')
//            ->select([
//                'authors.id as author_id',
//                'authors.author as author_name',
//                'books.id as book_id',
//                'books.name as book_name',
//                'books.year as book_year',
//                'books.lang as book_lang',
//                'books.pages as book_pages',
//            ])
//            ->limit(500)
//            ->join('author_book', 'author_id', '=', 'authors.id')
//            ->join('books', 'books.id', '=', 'author_book.book_id')
//            ->orderBy('authors.id', 'DESC')
//            ->get();

        return new AuthorsIterator($result);

    }
}
