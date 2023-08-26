<?php

namespace Unit\Author;

use App\Http\Repositories\Author\AuthorRepository;
use App\Http\Repositories\Author\Iterators\AuthorsIterator;
use App\Http\Services\Author\AuthorCacheService;
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
    protected MockObject $authorCacheService;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->authorRepository = $this->createMock(AuthorRepository::class);
        $this->authorsIterator = $this->createMock(AuthorsIterator::class);
        $this->authorCacheService = $this->createMock(AuthorCacheService::class);
        $this->service = new AuthorServices($this->authorRepository, $this->authorCacheService);

    }

    /**
     * @throws \Exception
     */
    public function testAuthorCacheInValid(): void
    {
        $this->authorCacheService
            ->expects($this->once())
            ->method('getAuthorCache')
            ->willReturn(null);

        $this->authorRepository
            ->expects($this->once())
            ->method('showIterator')
            ->willReturn($this->authorsIterator);

        $this->authorCacheService
            ->expects($this->once())
            ->method('setAuthorCache');

        $result = $this->service->showIterator();
        $this->assertSame($this->authorsIterator, $result);
    }

    /**
     * @throws \Exception
     */
    public function testAuthorCacheValid(): void
    {
        $this->authorCacheService
            ->expects($this->once())
            ->method('getAuthorCache')
            ->willReturn($this->authorsIterator);

        $this->authorRepository
            ->expects($this->never())
            ->method('showIterator');

        $this->authorCacheService
            ->expects($this->never())
            ->method('setAuthorCache');

        $result = $this->service->showIterator();
        $this->assertSame($this->authorsIterator, $result);


    }

}
