<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\InfoWindowCollector;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractInfoWindowSubscriber extends AbstractSubscriber
{
    private ?InfoWindowCollector $infoWindowCollector = null;

    public function __construct(Formatter $formatter, InfoWindowCollector $infoWindowCollector)
    {
        parent::__construct($formatter);

        $this->setInfoWindowCollector($infoWindowCollector);
    }

    public function getInfoWindowCollector(): InfoWindowCollector
    {
        return $this->infoWindowCollector;
    }

    public function setInfoWindowCollector(InfoWindowCollector $infoWindowCollector)
    {
        $this->infoWindowCollector = $infoWindowCollector;
    }
}
