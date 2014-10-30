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
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Events\MouseEvent;

/**
 * Info window.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 * @link http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/docs/reference.html
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    private $content;

    /** @var \Ivory\GoogleMap\Base\Coordinate|null */
    private $position;

    /** @var \Ivory\GoogleMap\Base\Size|null */
    private $pixelOffset;

    /** @var boolean */
    private $open = false;

    /** @var string */
    private $openEvent = MouseEvent::CLICK;

    /** @var boolean */
    private $autoOpen = true;

    /** @var boolean */
    private $autoClose = true;

    /** @var string */
    private $type = InfoWindowType::DEFAULT_;

    /**
     * Creates an info window.
     *
     * @param string                                $content  The content.
     * @param \Ivory\GoogleMap\Base\Coordinate|null $position The position.
     */
    public function __construct($content, Coordinate $position = null)
    {
        parent::__construct('info_window_');

        $this->setContent($content);
        $this->setPosition($position);
    }

    /**
     * Gets the content.
     *
     * @return string The content.
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content The content.
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Checks if there is a position.
     *
     * @return boolean TRUE if there is a position else FALSE.
     */
    public function hasPosition()
    {
        return $this->position !== null;
    }

    /**
     * Gets the position.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate|null The position.
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $position The position.
     */
    public function setPosition(Coordinate $position = null)
    {
        $this->position = $position;
    }

    /**
     * Checks if there is a pixel offset.
     *
     * @return boolean TRUE if there is a pixel offset else FALSE.
     */
    public function hasPixelOffset()
    {
        return $this->pixelOffset !== null;
    }

    /**
     * Gets the pixel offset.
     *
     * @return \Ivory\GoogleMap\Base\Size|null The pixel offset.
     */
    public function getPixelOffset()
    {
        return $this->pixelOffset;
    }

    /**
     * Sets the pixel offset.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $pixelOffset The pixel offset.
     */
    public function setPixelOffset(Size $pixelOffset = null)
    {
        $this->pixelOffset = $pixelOffset;
    }

    /**
     * Checks if it is opened.
     *
     * @return boolean TRUE if it is opened else FALSE.
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * Sets the open flag.
     *
     * @param boolean $open TRUE if it is opened else FALSE.
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }

    /**
     * Gets the open event.
     *
     * @return string The open event.
     */
    public function getOpenEvent()
    {
        return $this->openEvent;
    }

    /**
     * Sets the open event.
     *
     * @param string $openEvent The open event.
     */
    public function setOpenEvent($openEvent)
    {
        $this->openEvent = $openEvent;
    }

    /**
     * Checks if it opens automatically when the open event is triggered.
     *
     * @return boolean TRUE if the it opens automatically when the open event is triggered else FALSE.
     */
    public function isAutoOpen()
    {
        return $this->autoOpen;
    }

    /**
     * Sets the auto open flag.
     *
     * @param boolean $autoOpen TRUE if it opens automatically when the open event is triggered else FALSE.
     */
    public function setAutoOpen($autoOpen)
    {
        $this->autoOpen = $autoOpen;
    }

    /**
     * Checks if it closes automatically when an open event is triggered.
     *
     * @return boolean TRUE if it closes automatically when an open event is triggered else FALSE.
     */
    public function isAutoClose()
    {
        return $this->autoClose;
    }

    /**
     * Sets the auto close flag.
     *
     * @param boolean $autoClose TRUE if it closes automatically when an open event is triggered else FALSE.
     */
    public function setAutoClose($autoClose)
    {
        $this->autoClose = $autoClose;
    }

    /**
     * Gets the type.
     *
     * @return string The type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param string $type The type.
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.extend(%s.getPosition())', $bound->getVariable(), $this->getVariable());
    }
}
