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

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Event\MouseEvent;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    private ?string $content = null;

    private string $type = InfoWindowType::DEFAULT_;

    private ?Coordinate $position = null;

    private ?Size $pixedOffset = null;

    private bool $open = false;

    private string $openEvent = MouseEvent::CLICK;

    private bool $autoOpen = true;

    private bool $autoClose = true;

    /**
     * @param string          $content
     * @param string          $type
     * @param Coordinate|null $position
     */
    public function __construct($content, $type = InfoWindowType::DEFAULT_, Coordinate $position = null)
    {
        $this->setContent($content);
        $this->setType($type);
        $this->setPosition($position);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function hasPosition(): bool
    {
        return $this->position !== null;
    }

    public function getPosition(): ?Coordinate
    {
        return $this->position;
    }

    /**
     * @param Coordinate|null $position
     */
    public function setPosition(Coordinate $position = null): void
    {
        $this->position = $position;
    }

    public function hasPixelOffset(): bool
    {
        return $this->pixedOffset !== null;
    }

    public function getPixelOffset(): ?Size
    {
        return $this->pixedOffset;
    }

    /**
     * @param Size|null $pixelOffset
     */
    public function setPixelOffset(Size $pixelOffset = null): void
    {
        $this->pixedOffset = $pixelOffset;
    }

    public function isOpen(): bool
    {
        return $this->open;
    }

    /**
     * @param bool $open
     */
    public function setOpen($open): void
    {
        $this->open = $open;
    }

    public function isAutoOpen(): bool
    {
        return $this->autoOpen;
    }

    /**
     * @param bool $autoOpen
     */
    public function setAutoOpen($autoOpen): void
    {
        $this->autoOpen = $autoOpen;
    }

    public function getOpenEvent(): string
    {
        return $this->openEvent;
    }

    /**
     * @param string $openEvent
     */
    public function setOpenEvent($openEvent): void
    {
        $this->openEvent = $openEvent;
    }

    public function isAutoClose(): bool
    {
        return $this->autoClose;
    }

    /**
     * @param bool $autoClose
     */
    public function setAutoClose($autoClose): void
    {
        $this->autoClose = $autoClose;
    }
}
