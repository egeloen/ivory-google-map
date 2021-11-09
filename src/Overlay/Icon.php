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

    private ?string $url = null;

    private ?Point $anchor = null;

    private ?Point $origin = null;

    private ?Size $scaledSize = null;

    private ?Size $size = null;

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

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function hasAnchor(): bool
    {
        return $this->anchor !== null;
    }

    public function getAnchor(): ?Point
    {
        return $this->anchor;
    }

    /**
     * @param Point|null $anchor
     */
    public function setAnchor(Point $anchor = null): void
    {
        $this->anchor = $anchor;
    }

    public function hasOrigin(): bool
    {
        return $this->origin !== null;
    }

    public function getOrigin(): ?Point
    {
        return $this->origin;
    }

    /**
     * @param Point|null $origin
     */
    public function setOrigin(Point $origin = null): void
    {
        $this->origin = $origin;
    }

    public function hasScaledSize(): bool
    {
        return $this->scaledSize !== null;
    }

    public function getScaledSize(): ?Size
    {
        return $this->scaledSize;
    }

    /**
     * @param Size|null $scaledSize
     */
    public function setScaledSize(Size $scaledSize = null): void
    {
        $this->scaledSize = $scaledSize;
    }

    public function hasSize(): bool
    {
        return $this->size !== null;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    /**
     * @param Size|null $size
     */
    public function setSize(Size $size = null): void
    {
        $this->size = $size;
    }
}
