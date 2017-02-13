<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteQueryRequest extends AbstractPlaceAutocompleteRequest
{
    /**
     * {@inheritdoc}
     */
    public function buildContext()
    {
        return 'queryautocomplete';
    }
}
