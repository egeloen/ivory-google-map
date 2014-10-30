<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * Marker renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerRenderer extends AbstractJsonRenderer
{
    /** @var \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer */
    private $animationRenderer;

    /**
     * Creates a marker renderer.
     *
     * @param \Ivory\JsonBuilder\JsonBuilder|null                                $jsonBuilder       The json builder.
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer|null $animationRenderer The animation renderer.
     */
    public function __construct(JsonBuilder $jsonBuilder = null, AnimationRenderer $animationRenderer = null)
    {
        parent::__construct($jsonBuilder);

        $this->setAnimationRenderer($animationRenderer ?: new AnimationRenderer());
    }

    /**
     * Gets the animation renderer.
     *
     * @return \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer The animation renderer.
     */
    public function getAnimationRenderer()
    {
        return $this->animationRenderer;
    }

    /**
     * Sets the animation renderer.
     *
     * @param \Ivory\GoogleMap\Helpers\Renderers\Overlays\AnimationRenderer $animationRenderer The animation renderer.
     */
    public function setAnimationRenderer(AnimationRenderer $animationRenderer)
    {
        $this->animationRenderer = $animationRenderer;
    }

    /**
     * Renders a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param \Ivory\GoogleMap\Map|null        $map    The map.
     *
     * @return string The rendered marker.
     */
    public function render(Marker $marker, Map $map = null)
    {
        $this->getJsonBuilder()
            ->reset()
            ->setValue('[position]', $marker->getPosition()->getVariable(), false);

        if ($map !== null) {
            $this->getJsonBuilder()->setValue('[map]', $map->getVariable(), false);
        }

        if ($marker->hasAnimation()) {
            $this->getJsonBuilder()->setValue(
                '[animation]',
                $this->animationRenderer->render($marker->getAnimation()),
                false
            );
        }

        if ($marker->hasIcon()) {
            $this->getJsonBuilder()->setValue('[icon]', $marker->getIcon()->getVariable(), false);
        }

        if ($marker->hasShadow()) {
            $this->getJsonBuilder()->setValue('[shadow]', $marker->getShadow()->getVariable(), false);
        }

        if ($marker->hasShape()) {
            $this->getJsonBuilder()->setValue('[shape]', $marker->getShape()->getVariable(), false);
        }

        $this->getJsonBuilder()->setValues($marker->getOptions());

        return sprintf('new google.maps.Marker(%s)', $this->getJsonBuilder()->build());
    }
}
