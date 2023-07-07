<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Resources\Book\BookStoreResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request): BookStoreResource
    {
        $data = $request->validated();
        return new BookStoreResource((object)$data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, BookShowRequest $request)
    {
        $request->merge([
            'id' => (int) $request->route('id')
        ]);
        $request->validated();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
