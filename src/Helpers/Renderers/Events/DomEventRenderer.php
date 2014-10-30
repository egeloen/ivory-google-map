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

use Ivory\GoogleMap\Events\Event;

/**
 * Dom event renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DomEventRenderer
{
    /**
     * Renders a dom event.
     *
     * @param \Ivory\GoogleMap\Events\Event $event The dom event.
     *
     * @return string The rendered dom event.
     */
    public function render(Event $event)
    {
        return sprintf(
            'google.maps.event.addDomListener(%s,"%s",%s,%s)',
            $event->getInstance(),
            $event->getEventName(),
            $event->getHandle(),
            $event->isCapture() ? 'true' : 'false'
        );
    }
}
