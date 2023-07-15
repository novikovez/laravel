<?php

namespace App\Http\Repositories\Category;

use App\Http\Repositories\Category\Iterators\CategoryIterator;
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
            ->where('id', '=', $id)
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

}
