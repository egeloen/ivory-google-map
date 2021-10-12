<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Control;

use InvalidArgumentException;
use Ivory\GoogleMap\Control\ScaleControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlRenderer extends AbstractJsonRenderer implements ControlRendererInterface
{
    private ?ControlPositionRenderer $controlPositionRenderer = null;

    private ?ScaleControlStyleRenderer $scaleControlStyleRenderer = null;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        ControlPositionRenderer $controlPositionRenderer,
        ScaleControlStyleRenderer $scaleControlStyleRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setControlPositionRenderer($controlPositionRenderer);
        $this->setScaleControlStyleRenderer($scaleControlStyleRenderer);
    }

    public function getControlPositionRenderer(): ControlPositionRenderer
    {
        return $this->controlPositionRenderer;
    }

    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer): void
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    public function getScaleControlStyleRenderer(): ScaleControlStyleRenderer
    {
        return $this->scaleControlStyleRenderer;
    }

    public function setScaleControlStyleRenderer(ScaleControlStyleRenderer $scaleControlStyleRenderer): void
    {
        $this->scaleControlStyleRenderer = $scaleControlStyleRenderer;
    }

    /**
     * @param ScaleControl $control
     */
    public function render($control): string
    {
        if (!$control instanceof ScaleControl) {
            throw new InvalidArgumentException(sprintf(
                'Expected a "%s", got "%s".',
                ScaleControl::class,
                is_object($control) ? get_class($control) : gettype($control)
            ));
        }


        return $this->getJsonBuilder()
            ->setValue('[position]', $this->controlPositionRenderer->render($control->getPosition()), false)
            ->setValue('[style]', $this->scaleControlStyleRenderer->render($control->getStyle()), false)
            ->build();
    }
}
