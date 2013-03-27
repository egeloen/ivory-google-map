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
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Info window which describes a google map info window.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    protected $content;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $position;

    /** @var \Ivory\GoogleMap\Base\Size */
    protected $pixedOffset;

    /** @var boolean */
    protected $open;

    /** @var string */
    protected $openEvent;

    /** @var boolean */
    protected $autoOpen;

    /** @var boolean */
    protected $autoClose;

    /**
     * Creates an info window.
     *
     * @param string                           $content     The info window content.
     * @param \Ivory\GoogleMap\Base\Coordinate $position    The info window position.
     * @param \Ivory\GoogleMap\Base\Size       $pixelOffset The info window pixel offset.
     * @param boolean                          $open        The info window open flag.
     * @param string                           $openEvent   The info window open event.
     * @param boolean                          $autoOpen    The info window auto open flag.
     * @param boolean                          $autoClose   The info window auto close flag
     */
    public function __construct(
        $content = '<p>Default content</p>',
        Coordinate $position = null,
        Size $pixelOffset = null,
        $open = false,
        $openEvent = MouseEvent::CLICK,
        $autoOpen = true,
        $autoClose = false
    ) {
        parent::__construct();

        $this->setPrefixJavascriptVariable('info_window_');

        $this->setContent($content);

        if ($position !== null) {
            $this->setPosition($position);
        }

        if ($pixelOffset !== null) {
            $this->setPixelOffset($pixelOffset);
        }

        $this->setOpen($open);
        $this->setOpenEvent($openEvent);

        $this->setAutoOpen($autoOpen);
        $this->setAutoClose($autoClose);
    }

    /**
     * Gets the infow window position.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The info window position.
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the info window position
     *
     * Available prototypes:
     *  - function setPosition(Ivory\GoogleMap\Base\Coordinate $position = null)
     *  - function setPosition(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the position is not valid.
     */
    public function setPosition()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->position = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->position === null) {
                $this->position = new Coordinate();
            }

            $this->position->setLatitude($args[0]);
            $this->position->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->position->setNoWrap($args[2]);
            }
        } elseif (!isset($args[0])) {
            $this->position = null;
        } else {
            throw OverlayException::invalidInfoWindowPosition();
        }
    }

    /**
     * Checks if the info window has a pixel offset.
     *
     * @return boolean TRUE if the info window has a pixel offset else FALSE.
     */
    public function hasPixelOffset()
    {
        return $this->pixedOffset !== null;
    }

    /**
     * Gets the pixel offset.
     *
     * @return \Ivory\GoogleMap\Base\Size The pixel offset.
     */
    public function getPixelOffset()
    {
        return $this->pixedOffset;
    }

    /**
     * Sets the pixel offset.
     *
     * Available prototypes:
     *  - function setPixelOffset(Ivory\GoogleMap\Base\Size $scaledSize)
     *  - function setPixelOffset(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the pixel offset is not valid (prototypes).
     */
    public function setPixelOffset()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Size)) {
            $this->pixedOffset = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            if ($this->pixedOffset === null) {
                $this->pixedOffset = new Size();
            }

            $this->pixedOffset->setWidth($args[0]);
            $this->pixedOffset->setHeight($args[1]);

            if (isset($args[2]) && is_string($args[2])) {
                $this->pixedOffset->setWidthUnit($args[2]);
            }

            if (isset($args[3]) && is_string($args[3])) {
                $this->pixedOffset->setHeightUnit($args[3]);
            }
        } elseif (!isset($args[0])) {
            $this->pixedOffset = null;
        } else {
            throw OverlayException::invalidInfoWindowPixelOffset();
        }
    }

    /**
     * Gets the info window content.
     *
     * @return string The info window content.
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the info window content
     *
     * @param string $content The info window content.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the content is not valid.
     */
    public function setContent($content)
    {
        if (!is_string($content)) {
            throw OverlayException::invalidInfoWindowContent();
        }

        $this->content = $content;
    }

    /**
     * Checks if the info window is open.
     *
     * @return boolean TRUE if the info window is open else FALSE.
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * Sets if the info window is open.
     *
     * @param boolean $open TRUE if the info window is open else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the info window open flag is not valid.
     */
    public function setOpen($open)
    {
        if (!is_bool($open)) {
            throw OverlayException::invalidInfoWindowOpen();
        }

        $this->open = $open;
    }

    /**
     * Checks if the info window auto open.
     *
     * @return boolean TRUE if the info window auto open on event else FALSE.
     */
    public function isAutoOpen()
    {
        return $this->autoOpen;
    }

    /**
     * Sets if the info window auto open.
     *
     * @param boolean $autoOpen TRUE if the info window auto open on event else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the auto open flag is not valid.
     */
    public function setAutoOpen($autoOpen)
    {
        if (!is_bool($autoOpen)) {
            throw OverlayException::invalidInfoWindowAutoOpen();
        }

        $this->autoOpen = $autoOpen;
    }

    /**
     * Gets the info window open event.
     *
     * @return string The info window open event.
     */
    public function getOpenEvent()
    {
        return $this->openEvent;
    }

    /**
     * Sets the info window open event.
     *
     * @param string $openEvent The info window open event.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the open event is not valid.
     */
    public function setOpenEvent($openEvent)
    {
        if (!in_array($openEvent, MouseEvent::getMouseEvents())) {
            throw OverlayException::invalidInfoWindowOpenEvent();
        }

        $this->openEvent = $openEvent;
    }

    /**
     * Gets the auto close flag.
     *
     * @return boolean TRUE if all opened info windows close when one is opened else FALSE.
     */
    public function isAutoClose()
    {
        return $this->autoClose;
    }

    /**
     * Sets the auto close flag.
     *
     * @param boolean $autoClose TRUE if all opened info windows close when one is opened else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the auto close flag is not valid.
     */
    public function setAutoClose($autoClose)
    {
        if (!is_bool($autoClose)) {
            throw OverlayException::invalidInfoWindowAutoClose();
        }

        $this->autoClose = $autoClose;
    }
}
