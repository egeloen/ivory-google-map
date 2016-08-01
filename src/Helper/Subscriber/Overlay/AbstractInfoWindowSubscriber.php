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
    /**
     * @var InfoWindowCollector
     */
    private $infoWindowCollector;

    /**
     * @param Formatter           $formatter
     * @param InfoWindowCollector $infoWindowCollector
     */
    public function __construct(Formatter $formatter, InfoWindowCollector $infoWindowCollector)
    {
        parent::__construct($formatter);

        $this->setInfoWindowCollector($infoWindowCollector);
    }

    /**
     * @return InfoWindowCollector
     */
    public function getInfoWindowCollector()
    {
        return $this->infoWindowCollector;
    }

    /**
     * @param InfoWindowCollector $infoWindowCollector
     */
    public function setInfoWindowCollector(InfoWindowCollector $infoWindowCollector)
    {
        $this->infoWindowCollector = $infoWindowCollector;
    }
}
