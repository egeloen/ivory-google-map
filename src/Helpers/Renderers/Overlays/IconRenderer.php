<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\GoogleMap\Overlays\Icon;

/**
 * Icon renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconRenderer extends AbstractJsonRenderer
{
    /**
     * Renders an icon.
     *
     * @param \Ivory\GoogleMap\Overlays\Icon $icon The icon.
     *
     * @return string The rendered icon.
     */
    public function render(Icon $icon)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[url]', $icon->getUrl());

        if ($icon->hasSize()) {
            $this->getJsonBuilder()->setValue('[size]', $icon->getSize()->getVariable(), false);
        }

        if ($icon->hasOrigin()) {
            $this->getJsonBuilder()->setValue('[origin]', $icon->getOrigin()->getVariable(), false);
        }

        if ($icon->hasAnchor()) {
            $this->getJsonBuilder()->setValue('[anchor]', $icon->getAnchor()->getVariable(), false);
        }

        if ($icon->hasScaledSize()) {
            $this->getJsonBuilder()->setValue('[scaledSize]', $icon->getScaledSize()->getVariable(), false);
        }

        return $this->getJsonBuilder()->build();
    }
}
