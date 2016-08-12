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

use Ivory\GoogleMap\Control\MapTypeControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\MapTypeIdRenderer;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlRenderer extends AbstractJsonRenderer implements ControlRendererInterface
{
    /**
     * @var MapTypeIdRenderer
     */
    private $mapTypeIdRenderer;

    /**
     * @var ControlPositionRenderer
     */
    private $controlPositionRenderer;

    /**
     * @var MapTypeControlStyleRenderer
     */
    private $mapTypeControlStyleRenderer;

    /**
     * @param Formatter                   $formatter
     * @param JsonBuilder                 $jsonBuilder
     * @param MapTypeIdRenderer           $mapTypeIdRenderer
     * @param ControlPositionRenderer     $controlPositionRenderer
     * @param MapTypeControlStyleRenderer $mapTypeControlStyleRenderer
     */
    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        MapTypeIdRenderer $mapTypeIdRenderer,
        ControlPositionRenderer $controlPositionRenderer,
        MapTypeControlStyleRenderer $mapTypeControlStyleRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setMapTypeIdRenderer($mapTypeIdRenderer);
        $this->setControlPositionRenderer($controlPositionRenderer);
        $this->setMapTypeControlStyleRenderer($mapTypeControlStyleRenderer);
    }

    /**
     * @return MapTypeIdRenderer
     */
    public function getMapTypeIdRenderer()
    {
        return $this->mapTypeIdRenderer;
    }

    /**
     * @param MapTypeIdRenderer $mapTypeIdRenderer
     */
    public function setMapTypeIdRenderer(MapTypeIdRenderer $mapTypeIdRenderer)
    {
        $this->mapTypeIdRenderer = $mapTypeIdRenderer;
    }

    /**
     * @return ControlPositionRenderer
     */
    public function getControlPositionRenderer()
    {
        return $this->controlPositionRenderer;
    }

    /**
     * @param ControlPositionRenderer $controlPositionRenderer
     */
    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer)
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    /**
     * @return MapTypeControlStyleRenderer
     */
    public function getMapTypeControlStyleRenderer()
    {
        return $this->mapTypeControlStyleRenderer;
    }

    /**
     * @param MapTypeControlStyleRenderer $mapTypeControlStyleRenderer
     */
    public function setMapTypeControlStyleRenderer(MapTypeControlStyleRenderer $mapTypeControlStyleRenderer)
    {
        $this->mapTypeControlStyleRenderer = $mapTypeControlStyleRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function render($control)
    {
        if (!$control instanceof MapTypeControl) {
            throw new \InvalidArgumentException(sprintf(
                'Expected a "%s", got "%s".',
                MapTypeControl::class,
                is_object($control) ? get_class($control) : gettype($control)
            ));
        }

        $jsonBuilder = $this->getJsonBuilder();

        foreach ($control->getIds() as $index => $id) {
            $jsonBuilder->setValue('[mapTypeIds]['.$index.']', $this->mapTypeIdRenderer->render($id), false);
        }

        return $jsonBuilder
            ->setValue('[position]', $this->controlPositionRenderer->render($control->getPosition()), false)
            ->setValue('[style]', $this->mapTypeControlStyleRenderer->render($control->getStyle()), false)
            ->build();
    }
}
