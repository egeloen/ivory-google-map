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

use Ivory\GoogleMap\Helper\Collector\Place\Base\AutocompleteCoordinateCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateSubscriber extends AbstractSubscriber
{
    private ?AutocompleteCoordinateCollector $coordinateCollector = null;

    private ?CoordinateRenderer $coordinateRenderer = null;

    public function __construct(
        Formatter $formatter,
        AutocompleteCoordinateCollector $coordinateCollector,
        CoordinateRenderer $coordinateRenderer
    ) {
        parent::__construct($formatter);

        $this->setCoordinateCollector($coordinateCollector);
        $this->setCoordinateRenderer($coordinateRenderer);
    }

    public function getCoordinateCollector(): AutocompleteCoordinateCollector
    {
        return $this->coordinateCollector;
    }

    public function setCoordinateCollector(AutocompleteCoordinateCollector $coordinateCollector): void
    {
        $this->coordinateCollector = $coordinateCollector;
    }

    public function getCoordinateRenderer(): CoordinateRenderer
    {
        return $this->coordinateRenderer;
    }

    public function setCoordinateRenderer(CoordinateRenderer $coordinateRenderer): void
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->coordinateCollector->collect($autocomplete) as $coordinate) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->coordinateRenderer->render($coordinate),
                'base.coordinates',
                $coordinate
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE => 'handleAutocomplete'];
    }
}
