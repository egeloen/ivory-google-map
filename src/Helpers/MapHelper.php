<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Ivory\GoogleMap\Map;

/**
 * Map helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelper extends AbstractHelper
{
    /**
     * Renders the map.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The rendered map.
     */
    public function render(Map $map)
    {
        return $this->renderStylesheet($map).$this->renderHtml($map).$this->renderJavascript($map);
    }

    /**
     * Renders the html.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The rendered html.
     */
    public function renderHtml(Map $map)
    {
        return $this->doRender($map, MapEvents::HTML);
    }

    /**
     * Renders the stylesheet.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The rendered stylesheet.
     */
    public function renderStylesheet(Map $map)
    {
        return $this->doRender($map, MapEvents::STYLESHEET);
    }

    /**
     * Renders the javascript.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The rendered javascript.
     */
    public function renderJavascript(Map $map)
    {
        return $this->doRender($map, MapEvents::JAVASCRIPT);
    }

    /**
     * Does the rendering of a map event.
     *
     * @param \Ivory\GoogleMap\Map $map       The map.
     * @param string               $eventName The event name.
     *
     * @return string The rendered map event.
     */
    private function doRender(Map $map, $eventName)
    {
        $this->getEventDispatcher()->dispatch($eventName, $mapEvent = new MapEvent($map));

        return $mapEvent->getCode();
    }
}
