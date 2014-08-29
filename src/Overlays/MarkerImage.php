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

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Marker image which describes a google map marker image.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerImage
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImage extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $url;

    /** @var \Ivory\GoogleMap\Base\Point */
    protected $anchor;

    /** @var \Ivory\GoogleMap\Base\Point */
    protected $origin;

    /** @var \Ivory\GoogleMap\Base\Size */
    protected $scaledSize;

    /** @var Ivory\GoogleMap\Base\Size */
    protected $size;

    /**
     * Create a marker image.
     */
    public function __construct(
        $url = '//maps.gstatic.com/mapfiles/markers/marker.png',
        Point $anchor = null,
        Point $origin = null,
        Size $scaledSize = null,
        Size $size = null
    ) {
        $this->setPrefixJavascriptVariable('marker_image_');
        $this->setUrl($url);

        if ($anchor !== null) {
            $this->setAnchor($anchor);
        }

        if ($origin !== null) {
            $this->setOrigin($origin);
        }

        if ($scaledSize !== null) {
            $this->setScaledSize($scaledSize);
        }

        if ($size !== null) {
            $this->setSize($size);
        }
    }

    /**
     * Gets the url of the marker image.
     *
     * @return string The url of the marker image.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url of the marker image.
     *
     * @param string $url The url of the marker image.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the url is not valid.
     */
    public function setUrl($url)
    {
        if (!is_string($url)) {
            throw OverlayException::invalidMarkeImageUrl();
        }

        $this->url = $url;
    }

    /**
     * Checks if the marker image has an anchor.
     *
     * @return boolean TRUE if the marker image has an anchor else FALSE.
     */
    public function hasAnchor()
    {
        return $this->anchor !== null;
    }

    /**
     * Gets the anchor of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Point The marker image anchor.
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Sets the anchor of the marker image
     *
     * Available prototypes:
     *  - function setAnchor(Ivory\GoogleMap\Base\Point $anchor = null)
     *  - function setAnchor(double x, double y)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the anchor is not valid (prototypes).
     */
    public function setAnchor()
    {
        $args = func_get_args();

        if ($args[0] instanceof Point) {
            $this->anchor = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->anchor === null) {
                $this->anchor = new Point();
            }

            $this->anchor->setX($args[0]);
            $this->anchor->setY($args[1]);
        } elseif (!isset($args[0])) {
            $this->anchor = null;
        } else {
            throw OverlayException::invalidMarkerImageAnchor();
        }
    }

    /**
     * Checks if the marker image has an origin.
     *
     * @return boolean TRUE if the marker image has an origin else FALSE.
     */
    public function hasOrigin()
    {
        return $this->origin !== null;
    }

    /**
     * Gets the origin of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Point The marker image origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin of the marker image
     *
     * Available prototypes:
     *  - function setOrigin(Ivory\GoogleMap\Base\Point $origin = null)
     *  - function setOrigin(double x, double y)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the origin is not valid.
     */
    public function setOrigin()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Point)) {
            $this->origin = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->origin === null) {
                $this->origin = new Point();
            }

            $this->origin->setX($args[0]);
            $this->origin->setY($args[1]);
        } elseif (!isset($args[0])) {
            $this->origin = null;
        } else {
            throw OverlayException::invalidMarkerImageOrigin();
        }
    }

    /**
     * Checks if the marker image has a scaled size else FALSE.
     *
     * @return boolean TRUE if the marker image has a scaled size else FALSE.
     */
    public function hasScaledSize()
    {
        return $this->scaledSize !== null;
    }

    /**
     * Gets the scaled size of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Size The marker image scaled size.
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    /**
     * Sets the scaled size of the marker image
     *
     * Available prototypes:
     *  - function setScaledSize(Ivory\GoogleMap\Base\Size $scaledSize = null)
     *  - function setScaledSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the scaled size is not valid.
     */
    public function setScaledSize()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Size)) {
            $this->scaledSize = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->scaledSize === null) {
                $this->scaledSize = new Size();
            }

            $this->scaledSize->setWidth($args[0]);
            $this->scaledSize->setHeight($args[1]);

            if (isset($args[2]) && is_string($args[2])) {
                $this->scaledSize->setWidthUnit($args[2]);
            }

            if (isset($args[3]) && is_string($args[3])) {
                $this->scaledSize->setHeightUnit($args[3]);
            }
        } elseif (!isset($args[0])) {
            $this->scaledSize = null;
        } else {
            throw OverlayException::invalidMarkerImageScaledSize();
        }
    }

    /**
     * Checks if the marker image has a size.
     *
     * @return boolean TRUE if the marker image has a size else FALSE.
     */
    public function hasSize()
    {
        return $this->size !== null;
    }

    /**
     * Gets the size of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Size The marker image size.
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size of the marker image.
     *
     * Available prototypes:
     *  - function setSize(Ivory\GoogleMap\Base\Size $size = null)
     *  - function setSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the size is not valid.
     */
    public function setSize()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Size)) {
            $this->size = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->size === null) {
                $this->size = new Size($args[0], $args[1]);
            }

            $this->size->setWidth($args[0]);
            $this->size->setHeight($args[1]);

            if (isset($args[2]) && is_string($args[2])) {
                $this->size->setWidthUnit($args[2]);
            }

            if (isset($args[3]) && is_string($args[3])) {
                $this->size->setHeightUnit($args[3]);
            }
        } elseif (!isset($args[0])) {
            $this->size = null;
        } else {
            throw OverlayException::invalidMarkerImageSize();
        }
    }
}
