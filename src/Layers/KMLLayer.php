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
use Ivory\GoogleMap\Exception\LayerException;

/**
 * KML Layer which describes a google map KML layer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayer extends AbstractOptionsAsset
{
    /** @var string */
    protected $url;

    /**
     * Creates a KML Layer.
     *
     * @param string $url The KML layer url.
     */
    public function __construct($url = null)
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('kml_layer_');

        if ($url !== null) {
            $this->setUrl($url);
        }
    }

    /**
     * Gets the KML Layer URL.
     *
     * @return string The KML Layer URL.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the KML Layer URL.
     *
     * @param string $url The KML layer URL.
     *
     * @throws \Ivory\GoogleMap\Exception\LayerException If the URL is not valid.
     */
    public function setUrl($url)
    {
        if (!is_string($url)) {
            throw LayerException::invalidKmlLayerUrl();
        }

        $this->url = $url;
    }
}
