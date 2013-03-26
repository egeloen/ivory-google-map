<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Helper\Geometry\EncodingHelper;

/**
 * Encoded polyline helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineHelper
{
    /** @var \Ivory\GoogleMap\Helper\Geometry\EncodingHelper */
    protected $encodingHelper;

    /**
     * Creates an encoded polyline helper.
     *
     * @param \Ivory\GoogleMap\Helper\Geometry\EncodingHelper $encodingHelper The encoding helper.
     */
    public function __construct(EncodingHelper $encodingHelper = null)
    {
        if ($encodingHelper === null) {
            $encodingHelper = new EncodingHelper();
        }

        $this->setEncodingHelper($encodingHelper);
    }

    /**
     * Gets the encoding helper.
     *
     * @return \Ivory\GoogleMap\Helper\Geometry\EncodingHelper The encoding helper.
     */
    public function getEncodingHelper()
    {
        return $this->encodingHelper;
    }

    /**
     * Sets the encoding helper.
     *
     * @param \Ivory\GoogleMap\Helper\Geometry\EncodingHelper $encodingHelper The encoding helper.
     */
    public function setEncodingHelper(EncodingHelper $encodingHelper)
    {
        $this->encodingHelper = $encodingHelper;
    }

    /**
     * Renders an encoded polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     * @param \Ivory\GoogleMap\Map                      $map             The map.
     *
     * @return string The JS output.
     */
    public function render(EncodedPolyline $encodedPolyline, Map $map)
    {
        $polylineOptions = $encodedPolyline->getOptions();

        $polylineJSONOptions = sprintf(
            '{"map":%s,"path":%s',
            $map->getJavascriptVariable(),
            $this->encodingHelper->renderDecodePath($encodedPolyline->getValue())
        );

        if (!empty($polylineOptions)) {
            $polylineJSONOptions .= ','.substr(json_encode($polylineOptions), 1);
        } else {
            $polylineJSONOptions .= '}';
        }

        return sprintf(
            '%s = new google.maps.Polyline(%s);'.PHP_EOL,
            $encodedPolyline->getJavascriptVariable(),
            $polylineJSONOptions
        );
    }
}
