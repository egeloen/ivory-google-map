<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Controls;

use Ivory\GoogleMap\Controls\StreetViewControl;

/**
 * Street view control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlHelper
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /**
     * Creates a street view control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper $controlPositionHelper The control position helper.
     */
    public function __construct(ControlPositionHelper $controlPositionHelper = null)
    {
        if ($controlPositionHelper === null) {
            $controlPositionHelper = new ControlPositionHelper();
        }

        $this->setControlPositionHelper($controlPositionHelper);
    }

    /**
     * Gets the control position helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper The control position helper.
     */
    public function getControlPositionHelper()
    {
        return $this->controlPositionHelper;
    }

    /**
     * Sets the control position helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper $controlPositionHelper The control position helper.
     */
    public function setControlPositionHelper(ControlPositionHelper $controlPositionHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
    }

    /**
     * Renders the street view control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\StreetViewControl $streetViewControl
     * @return string HTML output
     */
    public function render(StreetViewControl $streetViewControl)
    {
        return sprintf(
            '{"position":%s}',
            $this->controlPositionHelper->render($streetViewControl->getControlPosition())
        );
    }
}
