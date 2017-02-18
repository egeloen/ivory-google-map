<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Icon
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Icon implements VariableAwareInterface
{
    const DEFAULT_URL = 'https://maps.gstatic.com/mapfiles/markers/marker.png';

    use VariableAwareTrait;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Point|null
     */
    private $anchor;

    /**
     * @var Point|null
     */
    private $origin;

    /**
     * @var Size|null
     */
    private $scaledSize;

    /**
     * @var Size|null
     */
    private $size;

    /**
     * @param string     $url
     * @param Point|null $anchor
     * @param Point|null $origin
     * @param Size|null  $scaledSize
     * @param Size|null  $size
     */
    public function __construct(
        $url = self::DEFAULT_URL,
        Point $anchor = null,
        Point $origin = null,
        Size $scaledSize = null,
        Size $size = null
    ) {
        $this->setUrl($url);
        $this->setAnchor($anchor);
        $this->setOrigin($origin);
        $this->setScaledSize($scaledSize);
        $this->setSize($size);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function hasAnchor()
    {
        return $this->anchor !== null;
    }

    /**
     * @return Point|null
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * @param Point|null $anchor
     */
    public function setAnchor(Point $anchor = null)
    {
        $this->anchor = $anchor;
    }

    /**
     * @return bool
     */
    public function hasOrigin()
    {
        return $this->origin !== null;
    }

    /**
     * @return Point|null
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param Point|null $origin
     */
    public function setOrigin(Point $origin = null)
    {
        $this->origin = $origin;
    }

    /**
     * @return bool
     */
    public function hasScaledSize()
    {
        return $this->scaledSize !== null;
    }

    /**
     * @return Size|null
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    /**
     * @param Size|null $scaledSize
     */
    public function setScaledSize(Size $scaledSize = null)
    {
        $this->scaledSize = $scaledSize;
    }

    /**
     * @return bool
     */
    public function hasSize()
    {
        return $this->size !== null;
    }

    /**
     * @return Size|null
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param Size|null $size
     */
    public function setSize(Size $size = null)
    {
        $this->size = $size;
    }
}
