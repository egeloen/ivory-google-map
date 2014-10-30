<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Geometry;

/**
 * Encoding renderer.
 *
 * @link http://code.google.com/apis/maps/documentation/javascript/reference.html#encoding
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingRenderer
{
    /**
     * Renders a decode path.
     *
     * @param string $encodedPath The encoded path.
     *
     * @return string The rendered decode path.
     */
    public function renderDecodePath($encodedPath)
    {
        return sprintf('google.maps.geometry.encoding.decodePath("%s")', addslashes($encodedPath));
    }
}
