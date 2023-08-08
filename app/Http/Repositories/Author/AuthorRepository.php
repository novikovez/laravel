<?php

namespace App\Http\Repositories\Author;

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
            ->limit(200)
            ->get();

    }

}
