<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place;

use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteContainerRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerSubscriber extends AbstractSubscriber
{
    /**
     * @var AutocompleteContainerRenderer
     */
    private $containerRenderer;

    /**
     * @param Formatter                     $formatter
     * @param AutocompleteContainerRenderer $containerRenderer
     */
    public function __construct(Formatter $formatter, AutocompleteContainerRenderer $containerRenderer)
    {
        parent::__construct($formatter);

        $this->setContainerRenderer($containerRenderer);
    }

    /**
     * @return AutocompleteContainerRenderer
     */
    public function getContainerRenderer()
    {
        return $this->containerRenderer;
    }

    /**
     * @param AutocompleteContainerRenderer $containerRenderer
     */
    public function setContainerRenderer(AutocompleteContainerRenderer $containerRenderer)
    {
        $this->containerRenderer = $containerRenderer;
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
    {
        $autocomplete = $event->getAutocomplete();

        $event->addCode($this->getFormatter()->renderContainerAssignment(
            $autocomplete,
            $this->containerRenderer->render()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER => 'handleAutocomplete'];
    }
}
