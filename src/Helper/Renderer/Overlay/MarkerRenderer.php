<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Overlay;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRenderer extends AbstractJsonRenderer
{
    /**
     * @var AnimationRenderer
     */
    private $animationRenderer;

    /**
     * @var IconRenderer
     */
    private $iconRenderer;

    /**
     * @var MarkerShapeRenderer
     */
    private $markerShapeRenderer;

    /**
     * @param Formatter           $formatter
     * @param JsonBuilder         $jsonBuilder
     * @param AnimationRenderer   $animationRenderer
     * @param IconRenderer        $iconRenderer
     * @param MarkerShapeRenderer $markerShapeRenderer
     */
    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        AnimationRenderer $animationRenderer,
        IconRenderer $iconRenderer,
        MarkerShapeRenderer $markerShapeRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setAnimationRenderer($animationRenderer);
        $this->setIconRenderer($iconRenderer);
        $this->setMarkerShapeRenderer($markerShapeRenderer);
    }

    /**
     * @return AnimationRenderer
     */
    public function getAnimationRenderer()
    {
        return $this->animationRenderer;
    }

    /**
     * @param AnimationRenderer $animationRenderer
     */
    public function setAnimationRenderer(AnimationRenderer $animationRenderer)
    {
        $this->animationRenderer = $animationRenderer;
    }

    /**
     * @return IconRenderer
     */
    public function getIconRenderer()
    {
        return $this->iconRenderer;
    }

    /**
     * @param IconRenderer $iconRenderer
     */
    public function setIconRenderer(IconRenderer $iconRenderer)
    {
        $this->iconRenderer = $iconRenderer;
    }

    /**
     * @return MarkerShapeRenderer
     */
    public function getMarkerShapeRenderer()
    {
        return $this->markerShapeRenderer;
    }

    /**
     * @param MarkerShapeRenderer $markerShapeRenderer
     */
    public function setMarkerShapeRenderer(MarkerShapeRenderer $markerShapeRenderer)
    {
        $this->markerShapeRenderer = $markerShapeRenderer;
    }

    /**
     * @param Marker   $marker
     * @param Map|null $map
     *
     * @return string
     */
    public function render(Marker $marker, Map $map = null)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()
            ->setValue('[position]', $marker->getPosition()->getVariable(), false);

        if ($map !== null) {
            $jsonBuilder->setValue('[map]', $map->getVariable(), false);
        }

        if ($marker->hasAnimation()) {
            $jsonBuilder->setValue(
                '[animation]',
                $this->animationRenderer->render($marker->getAnimation()),
                false
            );
        }

        if ($marker->hasIcon()) {
            $jsonBuilder->setValue('[icon]', $this->iconRenderer->render($marker->getIcon()), false);
        }

        if ($marker->hasShape()) {
            $jsonBuilder->setValue('[shape]', $this->markerShapeRenderer->render($marker->getShape()), false);
        }

        $jsonBuilder->setValues($marker->getOptions());

        return $formatter->renderObjectAssignment($marker, $formatter->renderObject('Marker', [
            $jsonBuilder->build(),
        ]));
    }
}
