<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Assets\AbstractOptionsAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\OverlayException;
use Ivory\GoogleMap\Overlays\MarkerCluster;
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Exception\ControlException;

/**
 * Legend which describes a google map legend.
 *
 * @see https://developers.google.com/maps/tutorials/customizing/adding-a-legend
 * @author Elie CHARRA <elie.charra@gmail.com>
 */
class Legend extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    protected $name;

    /** @var array */
    protected $styles = array();

    /**
     * Creates a legend.
     *
     * @param string $position The legend name.
     */
    public function __construct(
        $name = "map_legend",
        $styles = array()
    ) {
        parent::__construct();

        $this->setPrefixJavascriptVariable('legend_');

        $this->setName($name);
        $this->setStyles($styles);
    }

    /**
     * Get the legend styles.
     *
     * @return string The legend name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the legend name.
     *
     * @param string $name The legend name.
     *
     * @return Ivory\GoogleMap\Overlays\Legend The legend.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the legend styles.
     *
     * @return array The legend styles.
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Set the legend CSS styles.
     *
     * @param array $styles The legend styles.
     *
     * @return Ivory\GoogleMap\Overlays\Legend The legend.
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;
        return $this;
    }

}
