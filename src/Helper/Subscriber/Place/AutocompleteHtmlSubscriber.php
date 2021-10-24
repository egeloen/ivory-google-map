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
use Ivory\GoogleMap\Helper\Renderer\Place\AutocompleteHtmlRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHtmlSubscriber extends AbstractSubscriber
{
    private ?AutocompleteHtmlRenderer $htmlRenderer = null;

    public function __construct(Formatter $formatter, AutocompleteHtmlRenderer $htmlRenderer)
    {
        parent::__construct($formatter);

        $this->setHtmlRenderer($htmlRenderer);
    }

    public function getHtmlRenderer(): AutocompleteHtmlRenderer
    {
        return $this->htmlRenderer;
    }

    public function setHtmlRenderer(AutocompleteHtmlRenderer $htmlRenderer): void
    {
        $this->htmlRenderer = $htmlRenderer;
    }

    public function handleAutocomplete(PlaceAutocompleteEvent $event): void
    {
        $event->addCode($this->htmlRenderer->render($event->getAutocomplete()));
    }

    public static function getSubscribedEvents(): array
    {
        return [PlaceAutocompleteEvents::HTML => 'handleAutocomplete'];
    }
}
