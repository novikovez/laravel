<?php

namespace Tests\Unit\DZ11;

use App\Http\Services\DZ11\aService;
use App\Http\Services\DZ11\Methods\evenNumber;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class aServiceTest extends TestCase
{

    protected aService $aService;
    protected evenNumber $evenNumber;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->evenNumber = $this->createMock(evenNumber::class);
        $this->aService = new aService($this->evenNumber);
    }

    /**
     * @dataProvider Tests\Unit\DZ11\DataProviders\dataProviderAService::provider()
     */
    public function testAService(array $data, array $result, ?int $expected): void
    {

        $this->evenNumber
            ->method('getEvenInt')
            ->willReturn($result);

        $test = $this->aService->aService($data);
        $this->assertEquals($expected, $test);
    }
}
