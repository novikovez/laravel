<?php

namespace Unit\Author;

use App\Http\Repositories\Author\AuthorRepository;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Services\Author\AuthorServices;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;


class AuthorIteratorServiceTest extends TestCase
{
    protected AuthorServices $service;
    protected MockObject $authorRepository;
    protected MockObject $authorsIterator;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->authorRepository = $this->createMock(AuthorRepository::class);
        $this->authorsIterator = $this->createMock(AuthorsIterator::class);
        $this->service = new AuthorServices($this->authorRepository);

    }

    /**
     * @throws \Exception
     */
    public function testAuthorCacheInValid(): void
    {
        if(Cache::get('authors') === null)
        {
            $this->authorRepository
                ->expects($this->once())
                ->method('showIterator')
                ->willReturn($this->authorsIterator);

            $result = $this->service->showIterator();
            $this->assertSame(true, $result instanceof AuthorsIterator);
        }
    }

    /**
     * @throws \Exception
     */
    public function testAuthorCacheValid(): void
    {
        Cache::remember('authors', 60, function () {
            return $this->authorsIterator;
        });

        if(Cache::get('authors'))
        {
            $this->authorRepository
                ->expects($this->never())
                ->method('showIterator');

            $result = $this->service->showIterator();
            $this->assertSame(true, $result instanceof AuthorsIterator);
        }


    }

}
