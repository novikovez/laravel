<?php

namespace App\Http\Repositories\Category;

use App\Http\Repositories\Category\Iterators\CategoryIterator;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{

    public function index(): Collection
    {

        $query = DB::table('categories');
        $query->select('id', 'name');

        $categoriesData = collect($query->get());

        return $categoriesData->map(function ($categoriesData) {
            return new CategoryIterator($categoriesData);
        });

    }

    public function store(string $name): int
    {
        return DB::table('categories')
            ->insertGetId([
                "name" => $name,
                "created_at" => NOW()
            ]);
    }

    public function show(int $id): CategoryIterator
    {



        return new CategoryIterator(DB::table('categories')
            ->select([
                'categories.id',
                'categories.name'
            ])
            ->join('books', 'category_id', '=', 'categories.id')
            ->where('categories.id', '=', $id)
            ->first());
    }

    public function update(int $id, string $name): int
    {
        return DB::table('categories')
            ->where('id', '=', $id)
            ->update([
                "name" => $name
            ]);
    }

    public function destroy($id): int
    {
        return DB::table('categories')->delete($id);
    }

    public function showModel($id): Collection
    {

        return Category::query()
        ->with('book')
        ->limit(2000)
        ->where('id', '=', $id)
        ->get();

    }

    public function showIterator($id): CategoryIterator
    {
        dd(DB::table('categories')
            ->select([
                'categories.id',
                'categories.name',
                'books.id',
                'books.name',
                'books.year',
                'books.lang',
                'books.pages',
                'books.pages',
            ])
            ->join('books', 'books.id', '=', 'categories.id')
            ->join('author_book', 'book_id', '=', 'books.id')
            ->join('authors', 'authors.id', '=', 'author_book.author_id')
            ->where('categories.id', '=', $id)
            ->limit(10)
            ->get());

        return new CategoryIterator(DB::table('categories')
            ->select([
                'categories.id',
                'categories.name'
            ])
            ->join('books', 'books.id', '=', 'categories.id')
            ->where('categories.id', '=', $id)
            ->limit(10)
            ->get());
    }
}
