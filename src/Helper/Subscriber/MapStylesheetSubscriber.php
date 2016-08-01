<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetTagRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapStylesheetSubscriber extends AbstractSubscriber
{
    /**
     * @var StylesheetTagRenderer
     */
    private $stylesheetTagRenderer;

    /**
     * @param Formatter             $formatter
     * @param StylesheetTagRenderer $stylesheetTagRenderer
     */
    public function __construct(Formatter $formatter, StylesheetTagRenderer $stylesheetTagRenderer)
    {
        parent::__construct($formatter);

        $this->setStylesheetTagRenderer($stylesheetTagRenderer);
    }

    /**
     * @return StylesheetTagRenderer
     */
    public function getStylesheetTagRenderer()
    {
        return $this->stylesheetTagRenderer;
    }

    /**
     * @param StylesheetTagRenderer $stylesheetTagRenderer
     */
    public function setStylesheetTagRenderer(StylesheetTagRenderer $stylesheetTagRenderer)
    {
        $this->stylesheetTagRenderer = $stylesheetTagRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $map = $event->getMap();

        if ($map->hasStylesheetOptions()) {
            $event->addCode($this->stylesheetTagRenderer->render('#'.$map->getHtmlId(), $map->getStylesheetOptions()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::STYLESHEET => 'handleMap'];
    }
}
