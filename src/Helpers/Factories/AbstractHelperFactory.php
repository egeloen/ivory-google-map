<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Factories;

/**
 * Abstract helper factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHelperFactory implements HelperFactoryInterface
{
    /** @var boolean */
    private $debug;

    /** @var integer */
    private $indentation;

    /**
     * Creates an helper factory.
     *
     * @param boolean $debug       The debug.
     * @param integer $indentation The indentation.
     */
    public function __construct($debug = false, $indentation = 4)
    {
        $this->setDebug($debug);
        $this->setIndentation($indentation);
    }

    /**
     * Checks if it is debug.
     *
     * @return boolean TRUE if it is debug else FALSE.
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Sets if it is debug.
     *
     * @param boolean $debug TRUE if it is debug else FALSE.
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * Gets the indentation.
     *
     * @return integer The indentation.
     */
    public function getIndentation()
    {
        return $this->indentation;
    }

    /**
     * Sets the indentation.
     *
     * @param integer $indentation The indentation.
     */
    public function setIndentation($indentation)
    {
        $this->indentation = $indentation;
    }
}
