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

use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Helper\AbstractHelper;
use Ivory\GoogleMap\Helper\MapTypeIdHelper;

/**
 * Map type control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlHelper extends AbstractHelper
{
    /** @var \Ivory\GoogleMap\Helper\MapTypeIdHelper */
    protected $mapTypeIdHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /** @var \Ivory\GoogleMap\Helper\Controls\MapTypeControleStyleHelper */
    protected $mapTypeControlStyleHelper;

    /**
     * Construct a map type control helper.
     *
     * @param \Ivory\GoogleMap\Helper\MapTypeIdHelper                     $mapTypeIdHelper           The map type ID helper.
     * @param \Ivory\GoogleMap\Helper\Controls\ControlPositionHelper      $controlPositionHelper     The control position helper.
     * @param \Ivory\GoogleMap\Helper\Controls\MapTypeControleStyleHelper $mapTypeControlStyleHelper The map type control style helper.
     */
    public function __construct(
        MapTypeIdHelper $mapTypeIdHelper = null,
        ControlPositionHelper $controlPositionHelper = null,
        MapTypeControlStyleHelper $mapTypeControlStyleHelper = null
    ) {
        parent::__construct();

        if ($mapTypeIdHelper === null) {
            $mapTypeIdHelper = new MapTypeIdHelper();
        }

        if ($controlPositionHelper === null) {
            $controlPositionHelper = new ControlPositionHelper();
        }

        if ($mapTypeControlStyleHelper === null) {
            $mapTypeControlStyleHelper = new MapTypeControlStyleHelper();
        }

        $this->setMapTypeIdHelper($mapTypeIdHelper);
        $this->setControlPositionHelper($controlPositionHelper);
        $this->setMapTypeControlStyleHelper($mapTypeControlStyleHelper);
    }

    /**
     * Gets the map type ID helper.
     *
     * @return \Ivory\GoogleMap\Helper\MapTypeIdHelper The map type ID helper.
     */
    public function getMapTypeIdHelper()
    {
        return $this->mapTypeIdHelper;
    }

    /**
     * Sets the map type ID helper.
     *
     * @param \Ivory\GoogleMap\Helper\MapTypeIdHelper $mapTypeIdHelper The map type ID helper.
     */
    public function setMapTypeIdHelper(MapTypeIdHelper $mapTypeIdHelper)
    {
        $this->mapTypeIdHelper = $mapTypeIdHelper;
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
     * Gets the map type control style helper.
     *
     * @return \Ivory\GoogleMap\Helper\Controls\MapTypeControlStyleHelper The map type control style helper.
     */
    public function getMapTypeControlStyleHelper()
    {
        return $this->mapTypeControlStyleHelper;
    }

    /**
     * Sets the map type control style helper.
     *
     * @param \Ivory\GoogleMap\Helper\Controls\MapTypeControlStyleHelper $mapTypeControlStyleHelper The map type
     *                                                                                              control style
     *                                                                                              helper.
     */
    public function setMapTypeControlStyleHelper(MapTypeControlStyleHelper $mapTypeControlStyleHelper)
    {
        $this->mapTypeControlStyleHelper = $mapTypeControlStyleHelper;
    }

    /**
     * Renders a map type control.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl The map type control.
     *
     * @return string The JS output.
     */
    public function render(MapTypeControl $mapTypeControl)
    {
        $this->jsonBuilder->reset();

        foreach ($mapTypeControl->getMapTypeIds() as $index => $mapTypeId) {
            $this->jsonBuilder->setValue(
                sprintf('[mapTypeIds][%d]', $index),
                $this->mapTypeIdHelper->render($mapTypeId),
                false
            );
        }

        return $this->jsonBuilder
            ->setValue(
                '[position]',
                $this->controlPositionHelper->render($mapTypeControl->getControlPosition()),
                false
            )
            ->setValue(
                '[style]',
                $this->mapTypeControlStyleHelper->render($mapTypeControl->getMapTypeControlStyle()),
                false
            )
            ->build();
    }
}
