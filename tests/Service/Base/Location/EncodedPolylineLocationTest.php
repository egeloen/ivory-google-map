<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Service\Base\Location;

use Ivory\GoogleMap\Service\Base\Location\EncodedPolylineLocation;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineLocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EncodedPolylineLocation
     */
    private $encodedPolylineLocation;

    /**
     * @var string
     */
    private $encodedPolyline;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineLocation = new EncodedPolylineLocation($this->encodedPolyline = 'value');
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(LocationInterface::class, $this->encodedPolylineLocation);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->encodedPolyline, $this->encodedPolylineLocation->getEncodedPolyline());
    }

    public function testEncodedPolyline()
    {
        $this->encodedPolylineLocation->setEncodedPolyline($encodedPolyline = 'foo');

        $this->assertSame($encodedPolyline, $this->encodedPolylineLocation->getEncodedPolyline());
    }

    public function testBuildQuery()
    {
        $this->assertSame('enc:'.$this->encodedPolyline, $this->encodedPolylineLocation->buildQuery());
    }
}
