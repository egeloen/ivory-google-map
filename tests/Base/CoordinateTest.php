<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Base;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\Tests\GoogleMap\AbstractTestCase;

/**
 * Coordinate test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    private $coordinate;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinate = new Coordinate($this->latitude = 1, $this->longitude = -1);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinate);
        unset($this->latitude);
        unset($this->longitude);
    }

    public function testInheritance()
    {
        $this->assertVariableAssetInstance($this->coordinate);
    }

    public function testInitialState()
    {
        $this->assertStringStartsWith('coordinate_', $this->coordinate->getVariable());

        $this->assertSame($this->latitude, $this->coordinate->getLatitude());
        $this->assertSame($this->longitude, $this->coordinate->getLongitude());
    }

    public function testSetLatitude()
    {
        $this->coordinate->setLatitude($latitude = 10);

        $this->assertSame($latitude, $this->coordinate->getLatitude());
    }

    /**
     * @dataProvider latitudeNoWrapProvider
     */
    public function testIsLatitudeNoWrap($latitude, $noWrap)
    {
        $this->coordinate->setLatitude($latitude);

        $this->assertSame($noWrap, $this->coordinate->isLatitudeNoWrap());
    }

    public function testSetLongitude()
    {
        $this->coordinate->setLongitude($longitude = 10);

        $this->assertSame($longitude, $this->coordinate->getLongitude());
    }

    /**
     * @dataProvider longitudeNoWrapProvider
     */
    public function testIsLongitudeNoWrap($longitude, $noWrap)
    {
        $this->coordinate->setLongitude($longitude);

        $this->assertSame($noWrap, $this->coordinate->isLongitudeNoWrap());
    }

    /**
     * @dataProvider noWrapProvider
     */
    public function testIsNoWrap($latitude, $longitude, $noWrap)
    {
        $this->coordinate->setLatitude($latitude);
        $this->coordinate->setLongitude($longitude);

        $this->assertSame($noWrap, $this->coordinate->isNoWrap());
    }

    /**
     * Gets the latitude no wrap provider.
     *
     * @return array The latitude no wrap provider.
     */
    public function latitudeNoWrapProvider()
    {
        return array(
            array(0, false),
            array(90, false),
            array(-90, false),
            array(91, true),
            array(-91, true),
        );
    }

    /**
     * Gets the longitude no wrap provider.
     *
     * @return array The longitude no wrap provider.
     */
    public function longitudeNoWrapProvider()
    {
        return array(
            array(0, false),
            array(180, false),
            array(-180, false),
            array(181, true),
            array(-181, true),
        );
    }

    /**
     * Gets the no wrap provider.
     *
     * @return array The no wrap provider.
     */
    public function noWrapProvider()
    {
        $noWraps = array();

        foreach ($this->latitudeNoWrapProvider() as $latitudeProvider) {
            foreach ($this->longitudeNoWrapProvider() as $longitudeProvider) {
                $noWraps[] = array(
                    $latitudeProvider[0],
                    $longitudeProvider[0],
                    $latitudeProvider[1] || $longitudeProvider[1],
                );
            }
        }

        return $noWraps;
    }
}
