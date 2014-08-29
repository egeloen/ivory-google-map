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
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Encoded polyline.
 *
 * @see http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolyline extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var string */
    protected $value;

    /**
     * Creates an encoded polyline.
     *
     * @param string $value The encoded polyline value.
     */
    public function __construct($value = null)
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('encoded_polyline_');

        if ($value !== null) {
            $this->setValue($value);
        }
    }

    /**
     * Gets the encoded polyline value.
     *
     * @return string The encoded polyline value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the encoded polyline value.
     *
     * @param string $value The encoded polyline value.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the encoded polyline value is not valid.
     */
    public function setValue($value)
    {
        if (!is_string($value)) {
            throw OverlayException::invalidEncodedPolylineValue();
        }

        $this->value = $value;
    }
}
