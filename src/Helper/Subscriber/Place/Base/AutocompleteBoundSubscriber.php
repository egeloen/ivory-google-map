<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place\Base;

use Ivory\GoogleMap\Helper\Collector\Place\Base\AutocompleteBoundCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Base\BoundRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundSubscriber extends AbstractSubscriber
{
    private ?AutocompleteBoundCollector $boundCollector = null;

    private ?BoundRenderer $boundRenderer = null;

    public function __construct(
        Formatter $formatter,
        AutocompleteBoundCollector $boundCollector,
        BoundRenderer $boundRenderer
    ) {
        parent::__construct($formatter);

        $this->setBoundCollector($boundCollector);
        $this->setBoundRenderer($boundRenderer);
    }

    public function getBoundCollector(): AutocompleteBoundCollector
    {
        return $this->boundCollector;
    }

    public function setBoundCollector(AutocompleteBoundCollector $boundCollector): void
    {
        $this->boundCollector = $boundCollector;
    }

    public function getBoundRenderer(): BoundRenderer
    {
        return $this->boundRenderer;
    }

    public function setBoundRenderer(BoundRenderer $boundRenderer): void
    {
        $this->boundRenderer = $boundRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->boundCollector->collect($autocomplete) as $bound) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->boundRenderer->render($bound),
                'base.bounds',
                $bound
            ));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_BASE_BOUND => 'handleAutocomplete'];
    }
}
