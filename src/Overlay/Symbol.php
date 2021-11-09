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
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference#Symbol
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Symbol implements OptionsAwareInterface, VariableAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    private ?string $path = null;

    private ?Point $anchor = null;

    private ?Point $labelOrigin = null;

    /**
     * @param string     $path
     * @param Point|null $anchor
     * @param Point|null $labelOrigin
     */
    public function __construct($path, Point $anchor = null, Point $labelOrigin = null, array $options = [])
    {
        $this->setPath($path);
        $this->setAnchor($anchor);
        $this->setLabelOrigin($labelOrigin);
        $this->setOptions($options);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
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

    public function hasLabelOrigin(): bool
    {
        return $this->labelOrigin !== null;
    }

    public function getLabelOrigin(): ?Point
    {
        return $this->labelOrigin;
    }

    /**
     * @param Point|null $labelOrigin
     */
    public function setLabelOrigin(Point $labelOrigin = null): void
    {
        $this->labelOrigin = $labelOrigin;
    }
}
