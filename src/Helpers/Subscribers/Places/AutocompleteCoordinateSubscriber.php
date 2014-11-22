<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Subscribers\Places;

use Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Coordinate subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteCoordinateSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator */
    private $coordinateAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer */
    private $coordinateRenderer;

    /**
     * Creates an autocomplete coordinate subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                               $formatter            The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator|null $coordinateAggregator The coordinate aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer|null                   $coordinateRenderer   The coordinate renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        AutocompleteCoordinateAggregator $coordinateAggregator = null,
        CoordinateRenderer $coordinateRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setCoordinateAggregator($coordinateAggregator ?: new AutocompleteCoordinateAggregator());
        $this->setCoordinateRenderer($coordinateRenderer ?: new CoordinateRenderer());
    }

    /**
     * Gets the coordinate aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator The coordinate aggregator.
     */
    public function getCoordinateAggregator()
    {
        return $this->coordinateAggregator;
    }

    /**
     * Sets the coordinate aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteCoordinateAggregator $coordinateAggregator The coordinate aggregator.
     */
    public function setCoordinateAggregator(AutocompleteCoordinateAggregator $coordinateAggregator)
    {
        $this->coordinateAggregator = $coordinateAggregator;
    }

    /**
     * Gets the coordinate renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer The coordinate renderer.
     */
    public function getCoordinateRenderer()
    {
        return $this->coordinateRenderer;
    }

    /**
     * Sets the coordinate renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\CoordinateRenderer $coordinateRenderer The coordinate renderer.
     */
    public function setCoordinateRenderer(CoordinateRenderer $coordinateRenderer)
    {
        $this->coordinateRenderer = $coordinateRenderer;
    }

    /**
     * Renders the autocomplete javascript base coordinates.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent $placesAutocompleteEvent The places autocomplete event.
     */
    public function onAutocomplete(PlacesAutocompleteEvent $placesAutocompleteEvent)
    {
        $autocomplete = $placesAutocompleteEvent->getAutocomplete();

        foreach ($this->coordinateAggregator->aggregate($autocomplete) as $coordinate) {
            $placesAutocompleteEvent->addCode($this->getFormatter()->formatContainerAssignment(
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
    public static function getSubscribedEvents()
    {
        return array(PlacesAutocompleteEvents::JAVASCRIPT_BASE_COORDINATE => 'onAutocomplete');
    }
}
