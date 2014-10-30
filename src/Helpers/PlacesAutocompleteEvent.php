<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers;

use Ivory\GoogleMap\Places\Autocomplete;

/**
 * Places autocomplete event.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteEvent extends AbstractEvent
{
    /** @var \Ivory\GoogleMap\Places\Autocomplete */
    private $autocomplete;

    /**
     * Creates a places autocomplete event.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     */
    public function __construct(Autocomplete $autocomplete)
    {
        $this->autocomplete = $autocomplete;
    }

    /**
     * Gets the autocomplete.
     *
     * @return \Ivory\GoogleMap\Places\Autocomplete The autocomplete.
     */
    public function getAutocomplete()
    {
        return $this->autocomplete;
    }
}
