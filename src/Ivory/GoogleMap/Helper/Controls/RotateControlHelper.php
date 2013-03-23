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

use Ivory\GoogleMap\Controls\RotateControl;

/**
 * Rotate control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlHelper
{
    /** @var \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /**
     * Creates a rotate control helper.
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
     * Renders a rotate control.
     *
     * @param \Ivory\GoogleMap\Controls\RotateControl $rotateControl The rotate control.
     *
     * @return string The JS output.
     */
    public function render(RotateControl $rotateControl)
    {
        return sprintf('{"position":%s}', $this->controlPositionHelper->render($rotateControl->getControlPosition()));
    }
}
