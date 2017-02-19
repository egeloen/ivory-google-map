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

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Helper\Renderer\Image\Base\PointRenderer;
use Ivory\GoogleMap\Overlay\Icon;
use Ivory\GoogleMap\Overlay\Marker;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerStyleRenderer extends AbstractStyleRenderer
{
    /**
     * @var PointRenderer
     */
    private $pointRenderer;

    /**
     * @param PointRenderer $pointRenderer
     */
    public function __construct(PointRenderer $pointRenderer)
    {
        $this->pointRenderer = $pointRenderer;
    }

    /**
     * @param Marker $marker
     *
     * @return string
     */
    public function render(Marker $marker)
    {
        $options = $marker->hasStaticOption('styles') ? $marker->getStaticOption('styles') : [];

        if ($marker->hasIcon()) {
            $icon = $marker->getIcon();

            if (!isset($options['icon']) && ($url = $icon->getUrl()) !== Icon::DEFAULT_URL) {
                $options['icon'] = $url;
            }

            if (!isset($options['anchor']) && $icon->hasAnchor()) {
                $options['anchor'] = $icon->getAnchor();
            }
        }

        if (isset($options['anchor']) && $options['anchor'] instanceof Point) {
            $options['anchor'] = $this->pointRenderer->render($options['anchor']);
        }

        return $this->renderStyle($options);
    }
}
