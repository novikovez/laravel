<?php

namespace Unit\DZ11;

use App\Http\Services\DZ11\aService;
use PHPUnit\Framework\TestCase;

class aServiceTest extends TestCase
{

    protected aService $aService;
    public static function provideDataForAService(): array
    {
        return [
            [
                [10,5,7,9,55,11,20,21,25,35,40],
                'expected' => 3,
            ],
            [
                [11,17,13],
                'expected' => 0,
            ],
            [
                [],
                'expected' => 0,
            ],

        ];
    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->aService = new aService();
    }

    /**
     * @dataProvider provideDataForAService
     */
    public function testAService(array $data, int $expected): void
    {
        $count = $this->aService->count($data);
        $this->assertEquals($count, $expected);
    }
}
