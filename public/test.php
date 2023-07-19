<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Http\Repositories\Book\Iterators\BookIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Test{
    public function testData(){
        DB::table('books')->where('year', '2020')
            ->chunkById(100, function (Collection $users) {
                return $users->map(function ($bookData) {
                    return new BookIterator($bookData);
                });
            });
    }
}

$data= new Test();

dd($data->testData());
