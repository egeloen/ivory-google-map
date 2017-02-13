<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Base;

use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OpeningHoursTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OpeningHours
     */
    private $openingHours;

    /**
     * @inheritdoc}
     */
    protected function setUp()
    {
        $this->openingHours = new OpeningHours();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->openingHours->hasOpenNow());
        $this->assertNull($this->openingHours->isOpenNow());
        $this->assertFalse($this->openingHours->hasPeriods());
        $this->assertEmpty($this->openingHours->getPeriods());
        $this->assertFalse($this->openingHours->hasWeekdayTexts());
        $this->assertEmpty($this->openingHours->getWeekdayTexts());
    }

    public function testOpenNow()
    {
        $this->openingHours->setOpenNow(true);

        $this->assertTrue($this->openingHours->hasOpenNow());
        $this->assertTrue($this->openingHours->isOpenNow());
    }

    public function testSetPeriods()
    {
        $this->openingHours->setPeriods($periods = [$period = $this->createPeriodMock()]);
        $this->openingHours->setPeriods($periods);

        $this->assertTrue($this->openingHours->hasPeriods());
        $this->assertTrue($this->openingHours->hasPeriod($period));
        $this->assertSame($periods, $this->openingHours->getPeriods());
    }

    public function testAddPeriods()
    {
        $this->openingHours->setPeriods($firstPeriods = [$this->createPeriodMock()]);
        $this->openingHours->addPeriods($secondPeriods = [$this->createPeriodMock()]);

        $this->assertTrue($this->openingHours->hasPeriods());
        $this->assertSame(array_merge($firstPeriods, $secondPeriods), $this->openingHours->getPeriods());
    }

    public function testAddPeriod()
    {
        $this->openingHours->addPeriod($period = $this->createPeriodMock());

        $this->assertTrue($this->openingHours->hasPeriods());
        $this->assertTrue($this->openingHours->hasPeriod($period));
        $this->assertSame([$period], $this->openingHours->getPeriods());
    }

    public function testRemovePeriod()
    {
        $this->openingHours->addPeriod($period = $this->createPeriodMock());
        $this->openingHours->removePeriod($period);

        $this->assertFalse($this->openingHours->hasPeriods());
        $this->assertFalse($this->openingHours->hasPeriod($period));
        $this->assertEmpty($this->openingHours->getPeriods());
    }

    public function testSetWeekdayTexts()
    {
        $this->openingHours->setWeekdayTexts($weekdayTexts = [$weekdayText = 'foo']);
        $this->openingHours->setWeekdayTexts($weekdayTexts);

        $this->assertTrue($this->openingHours->hasWeekdayTexts());
        $this->assertTrue($this->openingHours->hasWeekdayText($weekdayText));
        $this->assertSame($weekdayTexts, $this->openingHours->getWeekdayTexts());
    }

    public function testAddWeekdayTexts()
    {
        $this->openingHours->setWeekdayTexts($firstWeekdayTexts = ['foo']);
        $this->openingHours->addWeekdayTexts($secondWeekdayTexts = ['bar']);

        $this->assertTrue($this->openingHours->hasWeekdayTexts());
        $this->assertSame(array_merge($firstWeekdayTexts, $secondWeekdayTexts), $this->openingHours->getWeekdayTexts());
    }

    public function testAddWeekdayText()
    {
        $this->openingHours->addWeekdayText($weekdayText = 'foo');

        $this->assertTrue($this->openingHours->hasWeekdayTexts());
        $this->assertTrue($this->openingHours->hasWeekdayText($weekdayText));
        $this->assertSame([$weekdayText], $this->openingHours->getWeekdayTexts());
    }

    public function testRemoveWeekdayText()
    {
        $this->openingHours->addWeekdayText($weekdayText = 'foo');
        $this->openingHours->removeWeekdayText($weekdayText);

        $this->assertFalse($this->openingHours->hasWeekdayTexts());
        $this->assertFalse($this->openingHours->hasWeekdayText($weekdayText));
        $this->assertEmpty($this->openingHours->getWeekdayTexts());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Period
     */
    private function createPeriodMock()
    {
        return $this->createMock(Period::class);
    }
}
