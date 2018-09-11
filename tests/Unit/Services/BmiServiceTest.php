<?php

namespace Tests\Unit\Services;

use App\Models\Person;
use App\Services\BmiService;
use Tests\TestCase;

class BmiServiceTest extends TestCase
{
    /**
     * @param $height
     * @param $weight
     * @param $result
     * @throws \ReflectionException
     * @dataProvider bmiDataProvider
     */
    public function testCalcBmi($height, $weight, $result)
    {
        $bmiService = new BmiService();
        $method = new \ReflectionMethod(get_class($bmiService), 'calcBmi');
        $method->setAccessible(true);
        $actual = $method->invoke($bmiService, $height, $weight);
        $this->assertEquals($result, $actual, '', 0.2);
    }

    /**
     * @param $height
     * @param $weight
     * @param $result
     * @dataProvider bmiDataProvider
     */
    public function testGetBmi($height, $weight, $result)
    {
        $person = new Person();
        $person->height = $height;
        $person->weight = $weight;
        $actual = BmiService::getBmi($person);
        $this->assertEquals($result, $actual, '', 0.2);
    }

    public function bmiDataProvider()
    {
        return [
            [1.6, 60, 23.473],
            [1.8, 80, 24.6914],
            [1, 0, false],
            [0, 50, false],
        ];
    }

}
