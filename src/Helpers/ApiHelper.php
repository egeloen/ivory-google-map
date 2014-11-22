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

/**
 * Api helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelper extends AbstractHelper
{
    /**
     * Renders the api.
     *
     * @param array $items The item(s).
     *
     * @return string The rendered api.
     */
    public function render(array $items)
    {
        $this->getEventDispatcher()->dispatch(ApiEvents::JAVASCRIPT, $apiEvent = new ApiEvent($items));

        return $apiEvent->getCode();
    }
}
