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
use Ivory\GoogleMap\Control\RotateControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Validaide\Common\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlRenderer extends AbstractJsonRenderer implements ControlRendererInterface
{
    private ?ControlPositionRenderer $controlPositionRenderer = null;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        ControlPositionRenderer $controlPositionRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setControlPositionRenderer($controlPositionRenderer);
    }

    public function getControlPositionRenderer(): ControlPositionRenderer
    {
        return $this->controlPositionRenderer;
    }

    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer): void
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function render($control): string
    {
        if (!$control instanceof RotateControl) {
            throw new InvalidArgumentException(sprintf(
                'Expected a "%s", got "%s".',
                RotateControl::class,
                is_object($control) ? get_class($control) : gettype($control)
            ));
        }

        return $this->getJsonBuilder()
            ->setValue('[position]', $this->controlPositionRenderer->render($control->getPosition()), false)
            ->build();
    }
}
