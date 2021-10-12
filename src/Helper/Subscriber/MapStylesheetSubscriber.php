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
    private ?StylesheetTagRenderer $stylesheetTagRenderer = null;

    public function __construct(Formatter $formatter, StylesheetTagRenderer $stylesheetTagRenderer)
    {
        parent::__construct($formatter);

        $this->setStylesheetTagRenderer($stylesheetTagRenderer);
    }

    public function getStylesheetTagRenderer(): StylesheetTagRenderer
    {
        return $this->stylesheetTagRenderer;
    }

    public function setStylesheetTagRenderer(StylesheetTagRenderer $stylesheetTagRenderer): void
    {
        $this->stylesheetTagRenderer = $stylesheetTagRenderer;
    }

    public function handleMap(MapEvent $event): void
    {
        $map = $event->getMap();

        if ($map->hasStylesheetOptions()) {
            $event->addCode($this->stylesheetTagRenderer->render('#'.$map->getHtmlId(), $map->getStylesheetOptions()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::STYLESHEET => 'handleMap'];
    }
}
