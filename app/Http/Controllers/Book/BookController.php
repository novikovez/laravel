<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookDestroyRequest;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\Book\BookResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return BookResource::collection([
            (object)[
                "id" => rand(1,9),
                "name" => "Max",
                "author"=> "Maxim",
                "year"=> "22",
                "countPages"=> "1"
            ],
            (object)[
                "id" => rand(1,9),
                "name" => "Ivan",
                "author"=> "Ivanov",
                "year"=> "15",
                "countPages"=> "2"
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request): BookResource
    {
        $data = $request->validated();
        // Данні валідні, створив в базі новий запис та повернув ід, наприклад:
        $data['id'] = rand(1,9);
        return new BookResource((object)$data);

    }

    /**
     * Display the specified resource.
     */
    public function show(BookShowRequest $request): BookResource
    {
        $data = $request->validated();
        // Данні валідні, виводжу з бази запис
        return new BookResource((object)[
            "id" => $data['id'],
            "name" => "Ivan",
            "author"=> "Ivanov",
            "year"=> "15",
            "countPages"=> "2"
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request): BookResource
    {
        $data = $request->validated();
        /// Данні валідні, збережу в базі запис
        return new BookResource((object)$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookDestroyRequest $request): object
    {
        $data = $request->validated();
        /// Видаляю запис з $data['id']
        return (object)[
            "data" => [
                "id" => $data['id'],
                "action" => "Destroy"
            ]
        ];
    }
}
