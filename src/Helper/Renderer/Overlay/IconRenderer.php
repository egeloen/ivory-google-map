<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Overlay\Icon;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconRenderer extends AbstractJsonRenderer
{
    /**
     * @param Icon $icon
     *
     * @return string
     */
    public function render(Icon $icon)
    {
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[url]', $icon->getUrl());

        if ($icon->hasAnchor()) {
            $jsonBuilder->setValue('[anchor]', $icon->getAnchor()->getVariable(), false);
        }

        if ($icon->hasOrigin()) {
            $jsonBuilder->setValue('[origin]', $icon->getOrigin()->getVariable(), false);
        }

        if ($icon->hasScaledSize()) {
            $jsonBuilder->setValue('[scaledSize]', $icon->getScaledSize()->getVariable(), false);
        }

        if ($icon->hasSize()) {
            $jsonBuilder->setValue('[size]', $icon->getScaledSize()->getVariable(), false);
        }

        return $this->getFormatter()->renderObjectAssignment($icon, $jsonBuilder->build());
    }
}
