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
    /**
     * @var AutocompleteBoundCollector
     */
    private $boundCollector;

    /**
     * @var BoundRenderer
     */
    private $boundRenderer;

    /**
     * @param Formatter                  $formatter
     * @param AutocompleteBoundCollector $boundCollector
     * @param BoundRenderer              $boundRenderer
     */
    public function __construct(
        Formatter $formatter,
        AutocompleteBoundCollector $boundCollector,
        BoundRenderer $boundRenderer
    ) {
        parent::__construct($formatter);

        $this->setBoundCollector($boundCollector);
        $this->setBoundRenderer($boundRenderer);
    }

    /**
     * @return AutocompleteBoundCollector
     */
    public function getBoundCollector()
    {
        return $this->boundCollector;
    }

    /**
     * @param AutocompleteBoundCollector $boundCollector
     */
    public function setBoundCollector(AutocompleteBoundCollector $boundCollector)
    {
        $this->boundCollector = $boundCollector;
    }

    /**
     * @return BoundRenderer
     */
    public function getBoundRenderer()
    {
        return $this->boundRenderer;
    }

    /**
     * @param BoundRenderer $boundRenderer
     */
    public function setBoundRenderer(BoundRenderer $boundRenderer)
    {
        $this->boundRenderer = $boundRenderer;
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
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

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_BASE_BOUND => 'handleAutocomplete'];
    }
}
