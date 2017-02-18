<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Image\Overlay;

use Ivory\GoogleMap\Utility\OptionsAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPolylineStyleRenderer extends AbstractStyleRenderer
{
    /**
     * @param mixed[]               $styles
     * @param OptionsAwareInterface $polyline
     *
     * @return string
     */
    public function renderPolylineStyle(array $styles, OptionsAwareInterface $polyline)
    {
        if (!isset($styles['geodesic']) && $polyline->hasOption('geodisc')) {
            $styles['geodesic'] = $polyline->getOption('geodisc');
        }

        if (!isset($styles['color']) && $polyline->hasOption('strokeColor')) {
            $styles['color'] = $polyline->getOption('strokeColor');
        }

        if (!isset($styles['weight']) && $polyline->hasOption('strokeWeight')) {
            $styles['weight'] = $polyline->getOption('strokeWeight');
        }

        return $this->renderStyle($styles);
    }
}
