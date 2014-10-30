<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\Controls;

/**
 * Controls test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlsTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Controls\Controls */
    private $controls;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controls = new Controls();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->controls);
    }

    public function testDefaultState()
    {
        $this->assertNoMapTypeControl();
        $this->assertNoOverviewMapControl();
        $this->assertNoPanControl();
        $this->assertNoRotateControl();
        $this->assertNoScaleControl();
        $this->assertNoStreetViewControl();
        $this->assertNoZoomControl();
    }

    public function testSetMapTypeControl()
    {
        $this->controls->setMapTypeControl($mapTypeControl = $this->createMapTypeControlMock());

        $this->assertMapTypeControl($mapTypeControl);
    }

    public function testResetMapTypeControl()
    {
        $this->controls->setMapTypeControl($this->createMapTypeControlMock());
        $this->controls->setMapTypeControl(null);

        $this->assertNoMapTypeControl();
    }

    public function testSetOverviewMapControl()
    {
        $this->controls->setOverviewMapControl($overviewMapControl = $this->createOverviewMapControlMock());

        $this->assertOverviewMapControl($overviewMapControl);
    }

    public function testResetOverviewMapControl()
    {
        $this->controls->setOverviewMapControl($this->createOverviewMapControlMock());
        $this->controls->setOverviewMapControl(null);

        $this->assertNoOverviewMapControl();
    }

    public function testSetPanControl()
    {
        $this->controls->setPanControl($panControl = $this->createPanControlMock());

        $this->assertPanControl($panControl);
    }

    public function testResetPanControl()
    {
        $this->controls->setPanControl($this->createPanControlMock());
        $this->controls->setPanControl(null);

        $this->assertNoPanControl();
    }

    public function testSetRotateControl()
    {
        $this->controls->setRotateControl($rotateControl = $this->createRotateControlMock());

        $this->assertRotateControl($rotateControl);
    }

    public function testResetRotateControl()
    {
        $this->controls->setRotateControl($this->createRotateControlMock());
        $this->controls->setRotateControl(null);

        $this->assertNoRotateControl();
    }

    public function testSetScaleControl()
    {
        $this->controls->setScaleControl($scaleControl = $this->createScaleControlMock());

        $this->assertScaleControl($scaleControl);
    }

    public function testResetScaleControl()
    {
        $this->controls->setScaleControl($this->createScaleControlMock());
        $this->controls->setScaleControl(null);

        $this->assertNoScaleControl();
    }

    public function testSetStreetViewControl()
    {
        $this->controls->setStreetViewControl($streetViewControl = $this->createStreetViewControlMock());

        $this->assertStreetViewControl($streetViewControl);
    }

    public function testStreetViewControlWithNullValue()
    {
        $this->controls->setStreetViewControl($this->createStreetViewControlMock());
        $this->controls->setStreetViewControl(null);

        $this->assertNoStreetViewControl();
    }

    public function testSetZoomControl()
    {
        $this->controls->setZoomControl($zoomControl = $this->createZoomControlMock());

        $this->assertZoomControl($zoomControl);
    }

    public function testResetZoomControl()
    {
        $this->controls->setZoomControl($this->createZoomControlMock());
        $this->controls->setZoomControl(null);

        $this->assertNoZoomControl();
    }

    /**
     * Asserts a map type control.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl The map type control.
     */
    private function assertMapTypeControl($mapTypeControl)
    {
        $this->assertMapTypeControlInstance($mapTypeControl);

        $this->assertTrue($this->controls->hasMapTypeControl());
        $this->assertSame($mapTypeControl, $this->controls->getMapTypeControl());
    }

    /**
     * Asserts an overview map control.
     *
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl The overview map control.
     */
    private function assertOverviewMapControl($overviewMapControl)
    {
        $this->assertOverviewMapControlInstance($overviewMapControl);

        $this->assertTrue($this->controls->hasOverviewMapControl());
        $this->assertSame($overviewMapControl, $this->controls->getOverviewMapControl());
    }

    /**
     * Asserts a pan control.
     *
     * @param \Ivory\GoogleMap\Controls\PanControl $panControl The pan control.
     */
    private function assertPanControl($panControl)
    {
        $this->assertPanControlInstance($panControl);

        $this->assertTrue($this->controls->hasPanControl());
        $this->assertSame($panControl, $this->controls->getPanControl());
    }

    /**
     * Asserts a rotate control.
     *
     * @param \Ivory\GoogleMap\Controls\RotateControl $rotateControl The rotate control.
     */
    private function assertRotateControl($rotateControl)
    {
        $this->assertRotateControlInstance($rotateControl);

        $this->assertTrue($this->controls->hasRotateControl());
        $this->assertSame($rotateControl, $this->controls->getRotateControl());
    }

    /**
     * Asserts a scale control.
     *
     * @param \Ivory\GoogleMap\Controls\ScaleControl $scaleControl The scale control.
     */
    private function assertScaleControl($scaleControl)
    {
        $this->assertScaleControlInstance($scaleControl);

        $this->assertTrue($this->controls->hasScaleControl());
        $this->assertSame($scaleControl, $this->controls->getScaleControl());
    }

    /**
     * Asserts a street view control.
     *
     * @param \Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl The street view control.
     */
    private function assertStreetViewControl($streetViewControl)
    {
        $this->assertStreetViewControlInstance($streetViewControl);

        $this->assertTrue($this->controls->hasStreetViewControl());
        $this->assertSame($streetViewControl, $this->controls->getStreetViewControl());
    }

    /**
     * Asserts a zoom control.
     *
     * @param \Ivory\GoogleMap\Controls\ZoomControl $zoomControl The zoom control.
     */
    private function assertZoomControl($zoomControl)
    {
        $this->assertZoomControlInstance($zoomControl);

        $this->assertTrue($this->controls->hasZoomControl());
        $this->assertSame($zoomControl, $this->controls->getZoomControl());
    }

    /**
     * Asserts there is no map type control.
     */
    private function assertNoMapTypeControl()
    {
        $this->assertFalse($this->controls->hasMapTypeControl());
        $this->assertNull($this->controls->getMapTypeControl());
    }

    /**
     * Asserts there is no overview map control.
     */
    private function assertNoOverviewMapControl()
    {
        $this->assertFalse($this->controls->hasOverviewMapControl());
        $this->assertNull($this->controls->getOverviewMapControl());
    }

    /**
     * Asserts there is no pan control.
     */
    private function assertNoPanControl()
    {
        $this->assertFalse($this->controls->hasPanControl());
        $this->assertNull($this->controls->getPanControl());
    }

    /**
     * Asserts there is no rotate control.
     */
    private function assertNoRotateControl()
    {
        $this->assertFalse($this->controls->hasRotateControl());
        $this->assertNull($this->controls->getRotateControl());
    }

    /**
     * Asserts there is no scale control.
     */
    private function assertNoScaleControl()
    {
        $this->assertFalse($this->controls->hasScaleControl());
        $this->assertNull($this->controls->getScaleControl());
    }

    /**
     * Asserts there is no street view control.
     */
    private function assertNoStreetViewControl()
    {
        $this->assertFalse($this->controls->hasStreetViewControl());
        $this->assertNull($this->controls->getStreetViewControl());
    }

    /**
     * Asserts there is no zoom control.
     */
    private function assertNoZoomControl()
    {
        $this->assertFalse($this->controls->hasZoomControl());
        $this->assertNull($this->controls->getZoomControl());
    }
}
