<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Geometry;

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#encoding
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingRenderer extends AbstractRenderer
{
    /**
     * @param string $encodedPath
     *
     * @return string
     */
    public function renderDecodePath($encodedPath)
    {
        $formatter = $this->getFormatter();

        return $formatter->renderCall(
            $formatter->renderProperty($formatter->renderClass('geometry.encoding'), 'decodePath'),
            [$formatter->renderEscape($encodedPath)]
        );
    }
}
