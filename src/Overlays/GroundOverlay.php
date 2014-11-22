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
use Ivory\GoogleMap\Base\Bound;

/**
 * Ground overlay.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlay
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlay extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    private $url;

    /** @var \Ivory\GoogleMap\Base\Bound */
    private $bound;

    /**
     * Creates a ground overlay.
     *
     * @param string                      $url   The url.
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    public function __construct($url, Bound $bound)
    {
        parent::__construct('ground_overlay_');

        $this->setUrl($url);
        $this->setBound($bound);
    }

    /**
     * Gets the url.
     *
     * @return string The url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url.
     *
     * @param string $url The url.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.union(%s)', $bound->getVariable(), $this->bound->getVariable());
    }
}
