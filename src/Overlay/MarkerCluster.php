<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerCluster implements OptionsAwareInterface, VariableAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var OverlayManager|null
     */
    private $overlayManager;

    /**
     * @var string
     */
    private $type = MarkerClusterType::DEFAULT_;

    /**
     * @var Marker[]
     */
    private $markers = [];

    /**
     * @return bool
     */
    public function hasOverlayManager()
    {
        return $this->overlayManager !== null;
    }

    /**
     * @return OverlayManager|null
     */
    public function getOverlayManager()
    {
        return $this->overlayManager;
    }

    /**
     * @param OverlayManager $overlayManager
     */
    public function setOverlayManager(OverlayManager $overlayManager)
    {
        $this->overlayManager = $overlayManager;

        if ($overlayManager->getMarkerCluster() !== $this) {
            $overlayManager->setMarkerCluster($this);
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function hasMarkers()
    {
        return !empty($this->markers);
    }

    /**
     * @return Marker[]
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * @param Marker[] $markers
     */
    public function setMarkers(array $markers)
    {
        foreach ($this->markers as $marker) {
            $this->removeMarker($marker);
        }

        $this->addMarkers($markers);
    }

    /**
     * @param Marker[] $markers
     */
    public function addMarkers(array $markers)
    {
        foreach ($markers as $marker) {
            $this->addMarker($marker);
        }
    }

    /**
     * @param Marker $marker
     *
     * @return bool
     */
    public function hasMarker(Marker $marker)
    {
        return in_array($marker, $this->markers, true);
    }

    /**
     * @param Marker $marker
     */
    public function addMarker(Marker $marker)
    {
        if (!$this->hasMarker($marker)) {
            $this->markers[] = $marker;
        }

        $this->addExtendable($marker);
    }

    /**
     * @param Marker $marker
     */
    public function removeMarker(Marker $marker)
    {
        unset($this->markers[array_search($marker, $this->markers, true)]);
        $this->markers = empty($this->markers) ? [] : array_values($this->markers);
        $this->removeExtendable($marker);
    }

    /**
     * @param ExtendableInterface $extendable
     */
    private function addExtendable(ExtendableInterface $extendable)
    {
        if ($this->isAutoZoom()) {
            $this->getOverlayManager()->getMap()->getBound()->addExtendable($extendable);
        }
    }

    /**
     * @param ExtendableInterface $extendable
     */
    private function removeExtendable(ExtendableInterface $extendable)
    {
        if ($this->isAutoZoom()) {
            $this->getOverlayManager()->getMap()->getBound()->removeExtendable($extendable);
        }
    }

    /**
     * @return bool
     */
    private function isAutoZoom()
    {
        return $this->hasOverlayManager()
            && $this->getOverlayManager()->hasMap()
            && $this->getOverlayManager()->getMap()->isAutoZoom();
    }
}
