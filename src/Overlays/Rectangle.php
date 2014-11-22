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
use Ivory\GoogleMap\Base\Bound;

/**
 * Rectangle.
 *
 * @link https://developers.google.com/maps/documentation/javascript/reference#Rectangle
 * @author GeLo <geloen.eric@gmail.com>
 */
class Rectangle extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    private $bound;

    /**
     * Creates a rectangle.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    public function __construct(Bound $bound)
    {
        parent::__construct('rectangle_');

        $this->setBound($bound);
    }

    /**
     * Gets the bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.union(%s)', $bound->getVariable(), $this->bound->getVariable());
    }
}
