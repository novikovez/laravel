<?php

namespace Tests\Unit\DZ11;

use App\Http\Services\DZ11\bService;
use App\Http\Services\DZ11\Methods\oddNumber;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class bServiceTest extends TestCase
{

    protected bService $bService;
    protected oddNumber $oddNumber;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->oddNumber = $this->createMock(oddNumber::class);
        $this->bService = new bService($this->oddNumber);
    }

    /**
     * @dataProvider Tests\Unit\DZ11\DataProviders\dataProviderBService::provider()
     */
    public function testBService(array $data, array $result, int $expected): void
    {
        ///var_dump($result);
        $this->oddNumber
            ->method('getOddInt')
            ->willReturn($result);

        $test = $this->bService->bService($data);
        $this->assertEquals($test, $expected);
    }
}
