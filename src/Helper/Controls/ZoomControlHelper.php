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

use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Helper\AbstractHelper;

/**
 * Zoom control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlHelper extends AbstractHelper
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /** @var \vory\GoogleMap\Templating\Helper\Controls\ZoomControlStyleHelper */
    protected $zoomControlStyleHelper;

    /**
     * Create a zoom control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper  $controlPositionHelper  The control position
     *                                                                                        helper.
     * @param \Ivory\GoogleMap\Helper\Controls\ZoomControlStyleHelper $zoomControlStyleHelper The zoom control style
     *                                                                                        helper.
     */
    public function __construct(
        ControlPositionHelper $controlPositionHelper = null,
        ZoomControlStyleHelper $zoomControlStyleHelper = null
    ) {
        parent::__construct();

        if ($controlPositionHelper === null) {
            $controlPositionHelper = new ControlPositionHelper();
        }

        if ($zoomControlStyleHelper === null) {
            $zoomControlStyleHelper = new ZoomControlStyleHelper();
        }

        $this->setControlPositionHelper($controlPositionHelper);
        $this->setZoomControlStyleHelper($zoomControlStyleHelper);
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
     * Gets the zoom control style helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\ZoomControlStyleHelper The zoom control style helper.
     */
    public function getZoomControlStyleHelper()
    {
        return $this->zoomControlStyleHelper;
    }

    /**
     * Sets the zoom control style helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ZoomControlStyleHelper $zoomControlStyleHelper The zoom control style
     *                                                                                        helper.
     */
    public function setZoomControlStyleHelper(ZoomControlStyleHelper $zoomControlStyleHelper)
    {
        $this->zoomControlStyleHelper = $zoomControlStyleHelper;
    }

    /**
     * Renders a zoom control.
     *
     * @param \Ivory\GoogleMap\Controls\ZoomControl $zoomControl The zoom control.
     *
     * @return string The JS output.
     */
    public function render(ZoomControl $zoomControl)
    {
        return $this->jsonBuilder
            ->reset()
            ->setValue('[position]', $this->controlPositionHelper->render($zoomControl->getControlPosition()), false)
            ->setValue('[style]', $this->zoomControlStyleHelper->render($zoomControl->getZoomControlStyle()), false)
            ->build();
    }
}
