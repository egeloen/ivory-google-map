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

use Ivory\Tests\GoogleMap\AbstractTestCase as TestCase;

/**
 * Controls test case.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Asserts a map type control instance.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl The map type control.
     */
    protected function assertMapTypeControlInstance($mapTypeControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\MapTypeControl', $mapTypeControl);
    }

    /**
     * Asserts an overview map control instance.
     *
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl The overview map control.
     */
    protected function assertOverviewMapControlInstance($overviewMapControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\OverviewMapControl', $overviewMapControl);
    }

    /**
     * Asserts a pan control instance.
     *
     * @param \Ivory\GoogleMap\Controls\PanControl $panControl The pan control.
     */
    protected function assertPanControlInstance($panControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\PanControl', $panControl);
    }

    /**
     * Asserts a rotate control instance.
     *
     * @param \Ivory\GoogleMap\Controls\RotateControl $rotateControl The rotate control.
     */
    protected function assertRotateControlInstance($rotateControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\RotateControl', $rotateControl);
    }

    /**
     * Asserts a scale control instance.
     *
     * @param \Ivory\GoogleMap\Controls\ScaleControl $scaleControl The scale control.
     */
    protected function assertScaleControlInstance($scaleControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\ScaleControl', $scaleControl);
    }

    /**
     * Asserts a street view control instance.
     *
     * @param \Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl The street view control.
     */
    protected function assertStreetViewControlInstance($streetViewControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\StreetViewControl', $streetViewControl);
    }

    /**
     * Asserts a zoom control instance.
     *
     * @param \Ivory\GoogleMap\Controls\ZoomControl $zoomControl The zoom control.
     */
    protected function assertZoomControlInstance($zoomControl)
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\ZoomControl', $zoomControl);
    }
}
