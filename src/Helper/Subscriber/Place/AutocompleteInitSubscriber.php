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

use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Subscriber\AbstractDelegateSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteInitSubscriber extends AbstractDelegateSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getDelegatedSubscribedEvents()
    {
        return [
            PlaceAutocompleteEvents::JAVASCRIPT_INIT => [
                PlaceAutocompleteEvents::JAVASCRIPT_INIT_CONTAINER,
            ],
        ];
    }
}
