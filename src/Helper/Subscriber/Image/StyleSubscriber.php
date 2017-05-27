<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Image;

use Ivory\GoogleMap\Helper\Event\StaticMapEvent;
use Ivory\GoogleMap\Helper\Event\StaticMapEvents;
use Ivory\GoogleMap\Helper\Renderer\Image\StyleRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StyleSubscriber implements EventSubscriberInterface
{
    /**
     * @var StyleRenderer
     */
    private $styleRenderer;

    /**
     * @param StyleRenderer $styleRenderer
     */
    public function __construct(StyleRenderer $styleRenderer)
    {
        $this->styleRenderer = $styleRenderer;
    }

    /**
     * @param StaticMapEvent $event
     */
    public function handleMap(StaticMapEvent $event)
    {
        $map = $event->getMap();

        if (!$map->hasMapOption('styles')) {
            return;
        }

        $styles = [];

        foreach ($map->getStaticOption('styles') as $style) {
            $styles[] = $this->styleRenderer->render($style);
        }

        if (!empty($styles)) {
            $event->setParameter('style', $styles);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [StaticMapEvents::STYLE => 'handleMap'];
    }
}
