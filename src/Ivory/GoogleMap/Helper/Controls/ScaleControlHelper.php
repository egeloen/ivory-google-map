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

use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Helper\AbstractHelper;

/**
 * Scale control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelper extends AbstractHelper
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\ScaleControleStyleHelper */
    protected $scaleControlStyleHelper;

    /**
     * Construct a scale control helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper    $controlPositionHelper   The control position
     *                                                                                           helper.
     * @param \Ivory\GoogleMap\Helper\Controls\ScaleControleStyleHelper $scaleControlStyleHelper The scale control
     *                                                                                           style helper.
     */
    public function __construct(
        ControlPositionHelper $controlPositionHelper = null,
        ScaleControlStyleHelper $scaleControlStyleHelper = null
    ) {
        parent::__construct();

        if ($controlPositionHelper === null) {
            $controlPositionHelper = new ControlPositionHelper();
        }

        if ($scaleControlStyleHelper === null) {
            $scaleControlStyleHelper = new ScaleControlStyleHelper();
        }

        $this->setControlPositionHelper($controlPositionHelper);
        $this->setScaleControlStyleHelper($scaleControlStyleHelper);
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
     * Gets the scale control style helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\ScaleControlStyleHelper The scale control style helper.
     */
    public function getScaleControlStyleHelper()
    {
        return $this->scaleControlStyleHelper;
    }

    /**
     * Sets the scale control style helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\ScaleControlStyleHelper $scaleControlStyleHelper The scale control style
     *                                                                                          helper.
     */
    public function setScaleControlStyleHelper(ScaleControlStyleHelper $scaleControlStyleHelper)
    {
        $this->scaleControlStyleHelper = $scaleControlStyleHelper;
    }

    /**
     * Renders a scale control.
     *
     * @param \Ivory\GoogleMap\Controls\ScaleControl $scaleControl The scale control.
     *
     * @return string The JS output.
     */
    public function render(ScaleControl $scaleControl)
    {
        return $this->jsonBuilder
            ->reset()
            ->setValue('[position]', $this->controlPositionHelper->render($scaleControl->getControlPosition()), false)
            ->setValue('[style]', $this->scaleControlStyleHelper->render($scaleControl->getScaleControlStyle()), false)
            ->build();
    }
}
