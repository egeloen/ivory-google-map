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
 * Encoded polyline.
 *
 * @link http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolyline extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    private $value;

    /**
     * Creates an encoded polyline.
     *
     * @param string $value The value.
     */
    public function __construct($value)
    {
        parent::__construct('encoded_polyline_');

        $this->setValue($value);
    }

    /**
     * Gets the value.
     *
     * @return string The value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @param string $value The value.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function renderExtend(Bound $bound)
    {
        return sprintf('%s.getPath().forEach(function(e){%s.extend(e);})', $this->getVariable(), $bound->getVariable());
    }
}
