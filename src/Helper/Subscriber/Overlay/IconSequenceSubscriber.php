<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\IconSequenceCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\IconSequenceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSequenceSubscriber extends AbstractSubscriber
{
    /**
     * @var IconSequenceCollector
     */
    private $iconSequenceCollector;

    /**
     * @var IconSequenceRenderer
     */
    private $iconSequenceRenderer;

    /**
     * @param Formatter             $formatter
     * @param IconSequenceCollector $iconSequenceCollector
     * @param IconSequenceRenderer  $iconSequenceRenderer
     */
    public function __construct(
        Formatter $formatter,
        IconSequenceCollector $iconSequenceCollector,
        IconSequenceRenderer $iconSequenceRenderer
    ) {
        parent::__construct($formatter);

        $this->setIconSequenceCollector($iconSequenceCollector);
        $this->setIconSequenceRenderer($iconSequenceRenderer);
    }

    /**
     * @return IconSequenceCollector
     */
    public function getIconSequenceCollector()
    {
        return $this->iconSequenceCollector;
    }

    /**
     * @param IconSequenceCollector $iconSequenceCollector
     */
    public function setIconSequenceCollector(IconSequenceCollector $iconSequenceCollector)
    {
        $this->iconSequenceCollector = $iconSequenceCollector;
    }

    /**
     * @return IconSequenceRenderer
     */
    public function getIconSequenceRenderer()
    {
        return $this->iconSequenceRenderer;
    }

    /**
     * @param IconSequenceRenderer $iconSequenceRenderer
     */
    public function setIconSequenceRenderer(IconSequenceRenderer $iconSequenceRenderer)
    {
        $this->iconSequenceRenderer = $iconSequenceRenderer;
    }

    /**
     * @param MapEvent $event
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->getIconSequenceCollector()->collect($map) as $iconSequence) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->iconSequenceRenderer->render($iconSequence),
                'overlays.icon_sequences',
                $iconSequence
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_ICON_SEQUENCE => 'handleMap'];
    }
}
