<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

use Ivory\GoogleMap\Helper\Event\ApiEvent;
use Ivory\GoogleMap\Helper\Event\ApiEvents;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelper extends AbstractHelper
{
    /**
     * @param object[] $objects
     *
     * @return string
     */
    public function render(array $objects)
    {
        $this->getEventDispatcher()->dispatch(ApiEvents::JAVASCRIPT, $event = new ApiEvent($objects));

        return $event->getCode();
    }
}
