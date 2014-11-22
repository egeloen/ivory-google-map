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

use Ivory\GoogleMap\Assets\AbstractVariableAsset;
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;

/**
 * Icon.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#Icon
 * @author GeLo <geloen.eric@gmail.com>
 */
class Icon extends AbstractVariableAsset
{
    /** @var string */
    private $url;

    /** @var \Ivory\GoogleMap\Base\Point|null */
    private $anchor;

    /** @var \Ivory\GoogleMap\Base\Point|null */
    private $origin;

    /** @var \Ivory\GoogleMap\Base\Size|null */
    private $scaledSize;

    /** @var Ivory\GoogleMap\Base\Size|null */
    private $size;

    /**
     * Create an icon.
     *
     * @param string $url The url.
     */
    public function __construct($url)
    {
        parent::__construct('icon_');

        $this->setUrl($url);
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
     * Checks if there is an anchor.
     *
     * @return boolean TRUE if there is an anchor else FALSE.
     */
    public function hasAnchor()
    {
        return $this->anchor !== null;
    }

    /**
     * Gets the anchor.
     *
     * @return \Ivory\GoogleMap\Base\Point|null The anchor.
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Sets the anchor.
     *
     * @param \Ivory\GoogleMap\Base\Point|null $anchor The anchor.
     */
    public function setAnchor(Point $anchor = null)
    {
        $this->anchor = $anchor;
    }

    /**
     * Checks if there is an origin.
     *
     * @return boolean TRUE if there is an origin else FALSE.
     */
    public function hasOrigin()
    {
        return $this->origin !== null;
    }

    /**
     * Gets the origin.
     *
     * @return \Ivory\GoogleMap\Base\Point|null The origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin.
     *
     * @param \Ivory\GoogleMap\Base\Point|null $origin The origin.
     */
    public function setOrigin(Point $origin = null)
    {
        $this->origin = $origin;
    }

    /**
     * Checks if there is a scaled size.
     *
     * @return boolean TRUE if there is a scaled size else FALSE.
     */
    public function hasScaledSize()
    {
        return $this->scaledSize !== null;
    }

    /**
     * Gets the scaled size.
     *
     * @return \Ivory\GoogleMap\Base\Size|null The scaled size.
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    /**
     * Sets the scaled size.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $scaledSize The scaled size.
     */
    public function setScaledSize(Size $scaledSize = null)
    {
        $this->scaledSize = $scaledSize;
    }

    /**
     * Checks if there is a size.
     *
     * @return boolean TRUE if there is a size else FALSE.
     */
    public function hasSize()
    {
        return $this->size !== null;
    }

    /**
     * Gets the size.
     *
     * @return \Ivory\GoogleMap\Base\Size|null The size.
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $size The size.
     */
    public function setSize(Size $size = null)
    {
        $this->size = $size;
    }
}
