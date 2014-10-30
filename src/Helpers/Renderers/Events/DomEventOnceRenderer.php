<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Events;

use Ivory\GoogleMap\Events\DomEvent;

/**
 * Dom event once renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventOnceRenderer
{
    /**
     * Renders a dom event once.
     *
     * @param \Ivory\GoogleMap\Events\DomEvent $domEvent The dom event once.
     *
     * @return string The rendered dom event once.
     */
    public function render(DomEvent $domEvent)
    {
        return sprintf(
            'google.maps.event.addDomListenerOnce(%s,"%s",%s,%s)',
            $domEvent->getInstance(),
            $domEvent->getEventName(),
            $domEvent->getHandle(),
            $domEvent->isCapture() ? 'true' : 'false'
        );
    }
}
