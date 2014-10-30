<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Factories;

/**
 * Helper factory interface.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface HelperFactoryInterface
{
    /**
     * Creates an api helper.
     *
     * @return \Ivory\GoogleMap\Helpers\ApiHelper The api helper.
     */
    public function createApiHelper();

    /**
     * Creates a map helper.
     *
     * @return \Ivory\GoogleMap\Helpers\MapHelper The map helper.
     */
    public function createMapHelper();

    /**
     * Creates a places autocomplete helper.
     *
     * @return \Ivory\GoogleMap\Helpers\PlacesAutocompleteHelper The places autocomplete helper.
     */
    public function createPlacesAutocompleteHelper();
}
