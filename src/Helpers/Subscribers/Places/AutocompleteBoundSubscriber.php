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

use Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent;
use Ivory\GoogleMap\Helpers\PlacesAutocompleteEvents;
use Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer;
use Ivory\GoogleMap\Helpers\Subscribers\AbstractFormatterSubscriber;
use Ivory\GoogleMap\Helpers\Subscribers\Formatter;

/**
 * Autocomplete bound subscriber.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteBoundSubscriber extends AbstractFormatterSubscriber
{
    /** @var \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator */
    private $boundAggregator;

    /** @var \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer */
    private $boundRenderer;

    /**
     * Creates an autocomplete bound subscriber.
     *
     * @param \Ivory\GoogleMap\Helpers\Subscribers\Formatter|null                          $formatter       The formatter.
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator|null $boundAggregator The bound aggregator.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer|null                   $boundRenderer   The bound renderer.
     */
    public function __construct(
        Formatter $formatter = null,
        AutocompleteBoundAggregator $boundAggregator = null,
        BoundRenderer $boundRenderer = null
    ) {
        parent::__construct($formatter);

        $this->setBoundAggregator($boundAggregator ?: new AutocompleteBoundAggregator());
        $this->setBoundRenderer($boundRenderer ?: new BoundRenderer());
    }

    /**
     * Gets the bound aggregator.
     *
     * @return \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator The bound aggregator.
     */
    public function getBoundAggregator()
    {
        return $this->boundAggregator;
    }

    /**
     * Sets the bound aggregator.
     *
     * @param \Ivory\GoogleMap\Helpers\Aggregators\Places\AutocompleteBoundAggregator $boundAggregator The bound aggregator.
     */
    public function setBoundAggregator(AutocompleteBoundAggregator $boundAggregator)
    {
        $this->boundAggregator = $boundAggregator;
    }

    /**
     * Gets the bound renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer The bound renderer.
     */
    public function getBoundRenderer()
    {
        return $this->boundRenderer;
    }

    /**
     * Sets the bound renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Base\BoundRenderer $boundRenderer The bound renderer.
     */
    public function setBoundRenderer(BoundRenderer $boundRenderer)
    {
        $this->boundRenderer = $boundRenderer;
    }

    /**
     * Renders the autocomplete javascript base bounds.
     *
     * @param \Ivory\GoogleMap\Helpers\PlacesAutocompleteEvent $placesAutocompleteEvent The places autocomplete event.
     */
    public function onAutocomplete(PlacesAutocompleteEvent $placesAutocompleteEvent)
    {
        $autocomplete = $placesAutocompleteEvent->getAutocomplete();

        foreach ($this->boundAggregator->aggregate($autocomplete) as $bound) {
            $placesAutocompleteEvent->addCode($this->getFormatter()->formatContainerAssignment(
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
        return array(PlacesAutocompleteEvents::JAVASCRIPT_BASE_BOUND => 'onAutocomplete');
    }
}
