<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Templating\Helper\Base;

use Ivory\GoogleMap\Base\Coordinate,
    Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper;

/**
 * Coordinate helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateHelper = new CoordinateHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinateHelper);
    }

    public function testRender()
    {
        $coordinate = new Coordinate(1.1, 2.1, true);

        $this->assertSame('new google.maps.LatLng(1.1, 2.1, true)', $this->coordinateHelper->render($coordinate));
    }
}
