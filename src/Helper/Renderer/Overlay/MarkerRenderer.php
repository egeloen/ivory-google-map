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
     * @param Formatter         $formatter
     * @param JsonBuilder       $jsonBuilder
     * @param AnimationRenderer $animationRenderer
     */
    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        AnimationRenderer $animationRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setAnimationRenderer($animationRenderer);
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
            $jsonBuilder->setValue('[icon]', $marker->getIcon()->getVariable(), false);
        } elseif ($marker->hasSymbol()) {
            $jsonBuilder->setValue('[icon]', $marker->getSymbol()->getVariable(), false);
        }

        if ($marker->hasShape()) {
            $jsonBuilder->setValue('[shape]', $marker->getShape()->getVariable(), false);
        }

        $jsonBuilder->setValues($marker->getOptions());

        return $formatter->renderObjectAssignment($marker, $formatter->renderObject('Marker', [
            $jsonBuilder->build(),
        ]));
    }
}
