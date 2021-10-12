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

use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlRenderer extends AbstractRenderer
{
    private ?ControlPositionRenderer $controlPositionRenderer = null;

    public function __construct(Formatter $formatter, ControlPositionRenderer $controlPositionRenderer)
    {
        parent::__construct($formatter);

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

    public function render(CustomControl $customControl, Map $map): string
    {
        $formatter = $this->getFormatter();

        return $formatter->renderObjectCall(
            $map,
            $formatter->renderProperty(
                'controls['.$this->controlPositionRenderer->render($customControl->getPosition()).']',
                'push'
            ),
            [$formatter->renderCall('('.$formatter->renderClosure($customControl->getControl()).')')]
        );
    }
}
