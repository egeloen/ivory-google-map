<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\InfoWindow;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowCollector extends AbstractCollector
{
    const STRATEGY_MAP = 1;
    const STRATEGY_MARKER = 2;

    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @param MarkerCollector $markerCollector
     * @param string|null     $type
     */
    public function __construct(MarkerCollector $markerCollector, $type = null)
    {
        $this->setMarkerCollector($markerCollector);
        $this->setType($type);
    }

    /**
     * @return MarkerCollector
     */
    public function getMarkerCollector()
    {
        return $this->markerCollector;
    }

    /**
     * @param MarkerCollector $markerCollector
     */
    public function setMarkerCollector(MarkerCollector $markerCollector)
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param Map          $map
     * @param InfoWindow[] $infoWindows
     * @param int|null     $strategy
     *
     * @return InfoWindow[]
     */
    public function collect(Map $map, array $infoWindows = [], $strategy = null)
    {
        if ($strategy === null) {
            $strategy = self::STRATEGY_MAP | self::STRATEGY_MARKER;
        }

        if ($strategy & self::STRATEGY_MAP) {
            $infoWindows = $this->collectValues($map->getOverlayManager()->getInfoWindows(), $infoWindows);
        }

        if ($strategy & self::STRATEGY_MARKER) {
            foreach ($this->markerCollector->collect($map) as $marker) {
                if ($marker->hasInfoWindow()) {
                    $infoWindows = $this->collectValue($marker->getInfoWindow(), $infoWindows);
                }
            }
        }

        return $infoWindows;
    }

    /**
     * {@inheritdoc}
     */
    protected function collectValue($value, array $defaults = [])
    {
        if ($this->type !== null && $value->getType() !== $this->type) {
            return $defaults;
        }

        return parent::collectValue($value, $defaults);
    }
}
