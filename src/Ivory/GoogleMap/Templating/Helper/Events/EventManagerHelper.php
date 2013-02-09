<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper\Events;

use Ivory\GoogleMap\Events\EventManager;

/**
 * Event manager helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Events\EventHelper */
    protected $eventHelper;

    /**
     * Creates an event manager helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Events\EventHelper $eventHelper The event helper.
     */
    public function __construct(EventHelper $eventHelper = null)
    {
        if ($eventHelper === null) {
            $eventHelper = new EventHelper();
        }

        $this->setEventHelper($eventHelper);
    }

    /**
     * Gets the event helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Events\EventHelper The event helper.
     */
    public function getEventHelper()
    {
        return $this->eventHelper;
    }

    /**
     * Sets the event helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Events\EventHelper $eventHelper The event helper.
     */
    public function setEventHelper(EventHelper $eventHelper)
    {
        $this->eventHelper = $eventHelper;
    }

    /**
     * Renders the events wraps into the event manager
     *
     * @param \Ivory\GoogleMap\Events\EventManager $eventManager The event manager.
     *
     * @return string The JS output.
     */
    public function render(EventManager $eventManager)
    {
        $html = array();

        foreach ($eventManager->getDomEvents() as $domEvent) {
            $html[] = $this->eventHelper->renderDomEvent($domEvent);
        }

        foreach ($eventManager->getDomEventsOnce() as $domEventOnce) {
            $html[] = $this->eventHelper->renderDomEventOnce($domEventOnce);
        }

        foreach ($eventManager->getEvents() as $event) {
            $html[] = $this->eventHelper->renderEvent($event);
        }

        foreach ($eventManager->getEventsOnce() as $eventOnce) {
            $html[] = $this->eventHelper->renderEventOnce($eventOnce);
        }

        return implode('', $html);
    }
}
