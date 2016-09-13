<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\InfoBoxCollector;
use Ivory\GoogleMap\Helper\Collector\Overlay\MarkerCollector;
use Ivory\GoogleMap\Overlay\InfoWindowType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InfoBoxCollector
     */
    private $infoBoxCollector;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoBoxCollector = new InfoBoxCollector(new MarkerCollector());
    }

    public function testDefaultState()
    {
        $this->assertSame(InfoWindowType::INFO_BOX, $this->infoBoxCollector->getType());
    }
}
