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
    /**
     * @var AutocompleteHtmlRenderer
     */
    private $htmlRenderer;

    /**
     * @param Formatter                $formatter
     * @param AutocompleteHtmlRenderer $htmlRenderer
     */
    public function __construct(Formatter $formatter, AutocompleteHtmlRenderer $htmlRenderer)
    {
        parent::__construct($formatter);

        $this->setHtmlRenderer($htmlRenderer);
    }

    /**
     * @return AutocompleteHtmlRenderer
     */
    public function getHtmlRenderer()
    {
        return $this->htmlRenderer;
    }

    /**
     * @param AutocompleteHtmlRenderer $htmlRenderer
     */
    public function setHtmlRenderer(AutocompleteHtmlRenderer $htmlRenderer)
    {
        $this->htmlRenderer = $htmlRenderer;
    }

    /**
     * @param PlaceAutocompleteEvent $event
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
    {
        $event->addCode($this->htmlRenderer->render($event->getAutocomplete()));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::HTML => 'handleAutocomplete'];
    }
}
