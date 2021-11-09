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

    private ?OverlayManager $overlayManager = null;

    private string $type = MarkerClusterType::DEFAULT_;

    /**
     * @var Marker[]
     */
    private array $markers = [];

    public function hasOverlayManager(): bool
    {
        return $this->overlayManager !== null;
    }

    public function getOverlayManager(): ?OverlayManager
    {
        return $this->overlayManager;
    }

    public function setOverlayManager(OverlayManager $overlayManager): void
    {
        $this->overlayManager = $overlayManager;

        if ($overlayManager->getMarkerCluster() !== $this) {
            $overlayManager->setMarkerCluster($this);
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function hasMarkers(): bool
    {
        return !empty($this->markers);
    }

    /**
     * @return Marker[]
     */
    public function getMarkers(): array
    {
        return $this->markers;
    }

    /**
     * @param Marker[] $markers
     */
    public function setMarkers(array $markers): void
    {
        foreach ($this->markers as $marker) {
            $this->removeMarker($marker);
        }

        $this->addMarkers($markers);
    }

    /**
     * @param Marker[] $markers
     */
    public function addMarkers(array $markers): void
    {
        foreach ($markers as $marker) {
            $this->addMarker($marker);
        }
    }

    public function hasMarker(Marker $marker): bool
    {
        return in_array($marker, $this->markers, true);
    }

    public function addMarker(Marker $marker): void
    {
        if (!$this->hasMarker($marker)) {
            $this->markers[] = $marker;
        }

        $this->addExtendable($marker);
    }

    public function removeMarker(Marker $marker): void
    {
        unset($this->markers[array_search($marker, $this->markers, true)]);
        $this->markers = empty($this->markers) ? [] : array_values($this->markers);
        $this->removeExtendable($marker);
    }

    private function addExtendable(ExtendableInterface $extendable): void
    {
        if ($this->isAutoZoom()) {
            $this->getOverlayManager()->getMap()->getBound()->addExtendable($extendable);
        }
    }

    private function removeExtendable(ExtendableInterface $extendable): void
    {
        if ($this->isAutoZoom()) {
            $this->getOverlayManager()->getMap()->getBound()->removeExtendable($extendable);
        }
    }

    private function isAutoZoom(): bool
    {
        return $this->hasOverlayManager()
            && $this->getOverlayManager()->hasMap()
            && $this->getOverlayManager()->getMap()->isAutoZoom();
    }
}
