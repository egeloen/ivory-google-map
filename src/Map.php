<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Control\ControlManager;
use Ivory\GoogleMap\Event\EventManager;
use Ivory\GoogleMap\Layer\LayerManager;
use Ivory\GoogleMap\Overlay\OverlayManager;
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map implements VariableAwareInterface, StaticOptionsAwareInterface
{
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    private string $htmlId = 'map_canvas';

    private bool $autoZoom = false;

    private ?Coordinate $center = null;

    private ?Bound $bound = null;

    private ?ControlManager $controlManager = null;

    private ?EventManager $eventManager = null;

    private ?LayerManager $layerManager = null;

    private ?OverlayManager $overlayManager = null;

    /**
     * @var string[]
     */
    private array $libraries = [];

    /**
     * @var mixed[]
     */
    private array $mapOptions = [];

    /**
     * @var string[]
     */
    private array $stylesheetOptions = [];

    /**
     * @var string[]
     */
    private array $htmlAttributes = [];

    public function __construct()
    {
        $this->setCenter(new Coordinate());
        $this->setBound(new Bound());
        $this->setControlManager(new ControlManager());
        $this->setEventManager(new EventManager());
        $this->setOverlayManager(new OverlayManager());
        $this->setLayerManager(new LayerManager());
    }

    public function getHtmlId(): string
    {
        return $this->htmlId;
    }

    /**
     * @param string $htmlId
     */
    public function setHtmlId($htmlId): void
    {
        $this->htmlId = $htmlId;
    }

    public function isAutoZoom(): bool
    {
        return $this->autoZoom;
    }

    /**
     * @param bool $autoZoom
     */
    public function setAutoZoom($autoZoom): void
    {
        $this->autoZoom = $autoZoom;
    }

    public function getCenter(): Coordinate
    {
        return $this->center;
    }

    public function setCenter(Coordinate $center): void
    {
        $this->center = $center;
    }

    public function getBound(): Bound
    {
        return $this->bound;
    }

    public function setBound(Bound $bound): void
    {
        $this->bound = $bound;
    }

    public function getControlManager(): ControlManager
    {
        return $this->controlManager;
    }

    public function setControlManager(ControlManager $controlManager): void
    {
        $this->controlManager = $controlManager;
    }

    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    public function setEventManager(EventManager $eventManager): void
    {
        $this->eventManager = $eventManager;
    }

    public function getLayerManager(): ?LayerManager
    {
        return $this->layerManager;
    }

    public function setLayerManager(LayerManager $layerManager): void
    {
        $this->layerManager = $layerManager;

        if ($layerManager->getMap() !== $this) {
            $layerManager->setMap($this);
        }
    }

    public function getOverlayManager(): ?OverlayManager
    {
        return $this->overlayManager;
    }

    public function setOverlayManager(OverlayManager $overlayManager): void
    {
        $this->overlayManager = $overlayManager;

        if ($overlayManager->getMap() !== $this) {
            $overlayManager->setMap($this);
        }
    }

    public function hasLibraries(): bool
    {
        return !empty($this->libraries);
    }

    /**
     * @return string[]
     */
    public function getLibraries(): array
    {
        return $this->libraries;
    }

    /**
     * @param string[] $libraries
     */
    public function setLibraries(array $libraries): void
    {
        $this->libraries = [];
        $this->addLibraries($libraries);
    }

    /**
     * @param string[] $libraries
     */
    public function addLibraries(array $libraries): void
    {
        foreach ($libraries as $library) {
            $this->addLibrary($library);
        }
    }

    /**
     * @param string $library
     */
    public function hasLibrary($library): bool
    {
        return in_array($library, $this->libraries, true);
    }

    /**
     * @param string $library
     */
    public function addLibrary($library): void
    {
        if (!$this->hasLibrary($library)) {
            $this->libraries[] = $library;
        }
    }

    /**
     * @param string $library
     */
    public function removeLibrary($library): void
    {
        unset($this->libraries[array_search($library, $this->libraries, true)]);
        $this->libraries = empty($this->libraries) ? [] : array_values($this->libraries);
    }

    public function hasMapOptions(): bool
    {
        return !empty($this->mapOptions);
    }

    /**
     * @return mixed[]
     */
    public function getMapOptions(): array
    {
        return $this->mapOptions;
    }

    /**
     * @param mixed[] $mapOptions
     */
    public function setMapOptions(array $mapOptions): void
    {
        $this->mapOptions = [];
        $this->addMapOptions($mapOptions);
    }

    /**
     * @param mixed[] $mapOptions
     */
    public function addMapOptions(array $mapOptions): void
    {
        foreach ($mapOptions as $mapOption => $value) {
            $this->setMapOption($mapOption, $value);
        }
    }

    /**
     * @param string $mapOption
     */
    public function hasMapOption($mapOption): bool
    {
        return isset($this->mapOptions[$mapOption]);
    }

    /**
     * @param string $mapOption
     *
     * @return mixed
     */
    public function getMapOption($mapOption)
    {
        return $this->hasMapOption($mapOption) ? $this->mapOptions[$mapOption] : null;
    }

    /**
     * @param string $mapOption
     * @param mixed  $value
     */
    public function setMapOption($mapOption, $value): void
    {
        $this->mapOptions[$mapOption] = $value;
    }

    /**
     * @param string $mapOption
     */
    public function removeMapOption($mapOption): void
    {
        unset($this->mapOptions[$mapOption]);
    }

    public function hasStylesheetOptions(): bool
    {
        return !empty($this->stylesheetOptions);
    }

    /**
     * @return string[]
     */
    public function getStylesheetOptions(): array
    {
        return $this->stylesheetOptions;
    }

    /**
     * @param string[] $stylesheetOptions
     */
    public function setStylesheetOptions(array $stylesheetOptions): void
    {
        $this->stylesheetOptions = [];
        $this->addStylesheetOptions($stylesheetOptions);
    }

    /**
     * @param string[] $stylesheetOptions
     */
    public function addStylesheetOptions(array $stylesheetOptions): void
    {
        foreach ($stylesheetOptions as $stylesheetOption => $value) {
            $this->setStylesheetOption($stylesheetOption, $value);
        }
    }

    /**
     * @param string $stylesheetOption
     */
    public function hasStylesheetOption($stylesheetOption): bool
    {
        return isset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * @param string $stylesheetOption
     */
    public function getStylesheetOption($stylesheetOption): ?string
    {
        return $this->hasStylesheetOption($stylesheetOption) ? $this->stylesheetOptions[$stylesheetOption] : null;
    }

    /**
     * @param string $stylesheetOption
     * @param string $value
     */
    public function setStylesheetOption($stylesheetOption, $value): void
    {
        $this->stylesheetOptions[$stylesheetOption] = $value;
    }

    /**
     * @param string $stylesheetOption
     */
    public function removeStylesheetOption($stylesheetOption): void
    {
        unset($this->stylesheetOptions[$stylesheetOption]);
    }

    public function hasHtmlAttributes(): bool
    {
        return !empty($this->htmlAttributes);
    }

    /**
     * @return string[]
     */
    public function getHtmlAttributes(): array
    {
        return $this->htmlAttributes;
    }

    /**
     * @param string[] $htmlAttributes
     */
    public function setHtmlAttributes(array $htmlAttributes): void
    {
        $this->htmlAttributes = [];
        $this->addHtmlAttributes($htmlAttributes);
    }

    /**
     * @param string[] $htmlAttributes
     */
    public function addHtmlAttributes(array $htmlAttributes): void
    {
        foreach ($htmlAttributes as $htmlAttribute => $value) {
            $this->setHtmlAttribute($htmlAttribute, $value);
        }
    }

    /**
     * @param string $htmlAttribute
     */
    public function hasHtmlAttribute($htmlAttribute): bool
    {
        return isset($this->htmlAttributes[$htmlAttribute]);
    }

    /**
     * @param string $htmlAttribute
     */
    public function getHtmlAttribute($htmlAttribute): ?string
    {
        return $this->hasHtmlAttribute($htmlAttribute) ? $this->htmlAttributes[$htmlAttribute] : null;
    }

    /**
     * @param string $htmlAttribute
     * @param string $value
     */
    public function setHtmlAttribute($htmlAttribute, $value): void
    {
        $this->htmlAttributes[$htmlAttribute] = $value;
    }

    /**
     * @param string $htmlAttribute
     */
    public function removeHtmlAttribute($htmlAttribute): void
    {
        unset($this->htmlAttributes[$htmlAttribute]);
    }
}
