<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Layers;

use Ivory\GoogleMap\Assets\AbstractOptionsAsset;

/**
 * Kml layer.
 *
 * @link https://developers.google.com/maps/documentation/javascript/reference#KmlLayer
 * @author GeLo <geloen.eric@gmail.com>
 */
class KmlLayer extends AbstractOptionsAsset
{
    /** @var string */
    private $url;

    /**
     * Creates a kml layer.
     *
     * @param string $url The url.
     */
    public function __construct($url)
    {
        parent::__construct('kml_layer_');

        $this->setUrl($url);
    }

    /**
     * Gets the url.
     *
     * @return string The url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url.
     *
     * @param string $url The url.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
