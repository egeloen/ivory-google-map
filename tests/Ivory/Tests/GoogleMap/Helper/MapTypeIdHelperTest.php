<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper;

use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Helper\MapTypeIdHelper;

/**
 * Map type ID helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Helper\MapTypeIdHelper */
    protected $mapTypeIdHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeIdHelper = new MapTypeIdHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeIdHelper);
    }

    public function testRenderWithValidValue()
    {
        $this->assertSame('google.maps.MapTypeId.HYBRID', $this->mapTypeIdHelper->render(MapTypeId::HYBRID));
        $this->assertSame('google.maps.MapTypeId.ROADMAP', $this->mapTypeIdHelper->render(MapTypeId::ROADMAP));
        $this->assertSame('google.maps.MapTypeId.SATELLITE', $this->mapTypeIdHelper->render(MapTypeId::SATELLITE));
        $this->assertSame('google.maps.MapTypeId.TERRAIN', $this->mapTypeIdHelper->render(MapTypeId::TERRAIN));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The map type id can only be : hybrid, roadmap, satellite, terrain.
     */
    public function testRenderWithInvalidValue()
    {
        $this->mapTypeIdHelper->render('foo');
    }
}
