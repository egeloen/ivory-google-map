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

    /**
     * @var string
     */
    private $path;

    /**
     * @var Point|null
     */
    private $anchor;

    /**
     * @var Point|null
     */
    private $labelOrigin;

    /**
     * @param string     $path
     * @param Point|null $anchor
     * @param Point|null $labelOrigin
     * @param array      $options
     */
    public function __construct($path, Point $anchor = null, Point $labelOrigin = null, array $options = [])
    {
        $this->setPath($path);
        $this->setAnchor($anchor);
        $this->setLabelOrigin($labelOrigin);
        $this->setOptions($options);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
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
    public function hasLabelOrigin()
    {
        return $this->labelOrigin !== null;
    }

    /**
     * @return Point|null
     */
    public function getLabelOrigin()
    {
        return $this->labelOrigin;
    }

    /**
     * @param Point|null $labelOrigin
     */
    public function setLabelOrigin(Point $labelOrigin = null)
    {
        $this->labelOrigin = $labelOrigin;
    }
}
