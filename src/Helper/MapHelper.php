<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelper extends AbstractHelper
{
    public function render(Map $map): string
    {
        return $this->renderHtml($map).$this->renderStylesheet($map).$this->renderJavascript($map);
    }

    public function renderHtml(Map $map): string
    {
        return $this->doRender($map, MapEvents::HTML);
    }

    public function renderStylesheet(Map $map): string
    {
        return $this->doRender($map, MapEvents::STYLESHEET);
    }

    public function renderJavascript(Map $map): string
    {
        return $this->doRender($map, MapEvents::JAVASCRIPT);
    }

    /**
     * @param string $eventName
     *
     */
    private function doRender(Map $map, $eventName): ?string
    {
        $this->getEventDispatcher()->dispatch($event = new MapEvent($map),$eventName);

        return $event->getCode();
    }
}
