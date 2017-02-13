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

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $type = InfoWindowType::DEFAULT_;

    /**
     * @var Coordinate|null
     */
    private $position;

    /**
     * @var Size|null
     */
    private $pixedOffset;

    /**
     * @var bool
     */
    private $open = false;

    /**
     * @var string
     */
    private $openEvent = MouseEvent::CLICK;

    /**
     * @var bool
     */
    private $autoOpen = true;

    /**
     * @var bool
     */
    private $autoClose = true;

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

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function hasPosition()
    {
        return $this->position !== null;
    }

    /**
     * @return Coordinate|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param Coordinate|null $position
     */
    public function setPosition(Coordinate $position = null)
    {
        $this->position = $position;
    }

    /**
     * @return bool
     */
    public function hasPixelOffset()
    {
        return $this->pixedOffset !== null;
    }

    /**
     * @return Size|null
     */
    public function getPixelOffset()
    {
        return $this->pixedOffset;
    }

    /**
     * @param Size|null $pixelOffset
     */
    public function setPixelOffset(Size $pixelOffset = null)
    {
        $this->pixedOffset = $pixelOffset;
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * @param bool $open
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }

    /**
     * @return bool
     */
    public function isAutoOpen()
    {
        return $this->autoOpen;
    }

    /**
     * @param bool $autoOpen
     */
    public function setAutoOpen($autoOpen)
    {
        $this->autoOpen = $autoOpen;
    }

    /**
     * @return string
     */
    public function getOpenEvent()
    {
        return $this->openEvent;
    }

    /**
     * @param string $openEvent
     */
    public function setOpenEvent($openEvent)
    {
        $this->openEvent = $openEvent;
    }

    /**
     * @return bool
     */
    public function isAutoClose()
    {
        return $this->autoClose;
    }

    /**
     * @param bool $autoClose
     */
    public function setAutoClose($autoClose)
    {
        $this->autoClose = $autoClose;
    }
}
