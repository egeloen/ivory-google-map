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
    private ?IconSequenceCollector $iconSequenceCollector = null;

    private ?IconSequenceRenderer $iconSequenceRenderer = null;

    public function __construct(
        Formatter $formatter,
        IconSequenceCollector $iconSequenceCollector,
        IconSequenceRenderer $iconSequenceRenderer
    ) {
        parent::__construct($formatter);

        $this->setIconSequenceCollector($iconSequenceCollector);
        $this->setIconSequenceRenderer($iconSequenceRenderer);
    }

    public function getIconSequenceCollector(): IconSequenceCollector
    {
        return $this->iconSequenceCollector;
    }

    public function setIconSequenceCollector(IconSequenceCollector $iconSequenceCollector): void
    {
        $this->iconSequenceCollector = $iconSequenceCollector;
    }

    public function getIconSequenceRenderer(): IconSequenceRenderer
    {
        return $this->iconSequenceRenderer;
    }

    public function setIconSequenceRenderer(IconSequenceRenderer $iconSequenceRenderer): void
    {
        $this->iconSequenceRenderer = $iconSequenceRenderer;
    }

    public function handleMap(MapEvent $event): void
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
    public static function getSubscribedEvents(): array
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_ICON_SEQUENCE => 'handleMap'];
    }
}
