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

use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\Period;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PeriodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Period
     */
    private $period;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->period = new Period();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->period->hasOpen());
        $this->assertNull($this->period->getOpen());
        $this->assertFalse($this->period->hasClose());
        $this->assertNull($this->period->getClose());
    }

    public function testOpen()
    {
        $this->period->setOpen($open = $this->createOpenClosePeriodMock());

        $this->assertTrue($this->period->hasOpen());
        $this->assertSame($open, $this->period->getOpen());
    }

    public function testClose()
    {
        $this->period->setClose($close = $this->createOpenClosePeriodMock());

        $this->assertTrue($this->period->hasClose());
        $this->assertSame($close, $this->period->getClose());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OpenClosePeriod
     */
    private function createOpenClosePeriodMock()
    {
        return $this->createMock(OpenClosePeriod::class);
    }
}
