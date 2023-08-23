<?php

namespace Tests\Unit\Author\DataProviders;

use App\Http\Repositories\Author\Iterators\AuthorsIterator;

class ProviderDataForAuthorIterator
{

    public static function providerDataForAuthorIterator(): array
    {
        return [
            [
                'exactlyRepository' => 1,
                'expected' => true,
            ],
            [
                'exactlyRepository' => 0,
                'expected' => false,
            ],
        ];
    }
}
