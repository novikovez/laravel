<?php

namespace App\Http\Repositories\Category;

use App\Http\Repositories\Category\Iterators\CategoriesIterator;
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

    public function showModel(): Collection
    {

        return Category::query()
        ->with('book')
        ->orderBy('id', 'DESC')
        ->whereBetween('categories.id', [0, 50])
        ->get();

    }

    /**
     * @throws \Exception
     */
    public function showIterator(): CategoriesIterator
    {
        $result = DB::table('categories')
            ->select([
                'categories.id as category_id',
                'categories.name as category_name',
                'books.id as book_id',
                'books.name as book_name',
                'books.year as book_year',
                'books.lang as book_lang',
                'books.pages as book_pages',
            ])
            ->join('books', 'categories.id', '=', 'books.category_id')
            ->orderBy('categories.id', 'DESC')
            ->whereBetween('categories.id', [0, 50])
            ->get();

        return new CategoriesIterator($result);


    }
}
