<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlManagerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Validaide\Common\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapRenderer extends AbstractJsonRenderer
{
    private ?MapTypeIdRenderer $mapTypeIdRenderer = null;

    private ?ControlManagerRenderer $controlManagerRenderer = null;

    private ?RequirementRenderer $requirementRenderer = null;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        MapTypeIdRenderer $mapTypeIdRenderer,
        ControlManagerRenderer $controlManagerRenderer,
        RequirementRenderer $requirementRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setMapTypeIdRenderer($mapTypeIdRenderer);
        $this->setControlManagerRenderer($controlManagerRenderer);
        $this->setRequirementRenderer($requirementRenderer);
    }

    public function getMapTypeIdRenderer(): MapTypeIdRenderer
    {
        return $this->mapTypeIdRenderer;
    }

    public function setMapTypeIdRenderer(MapTypeIdRenderer $mapTypeIdRenderer): void
    {
        $this->mapTypeIdRenderer = $mapTypeIdRenderer;
    }

    public function getControlManagerRenderer(): ControlManagerRenderer
    {
        return $this->controlManagerRenderer;
    }

    public function setControlManagerRenderer(ControlManagerRenderer $controlManagerRenderer): void
    {
        $this->controlManagerRenderer = $controlManagerRenderer;
    }

    public function getRequirementRenderer(): RequirementRenderer
    {
        return $this->requirementRenderer;
    }

    /**
     * @param RequirementRenderer $requirementRenderer
     */
    public function setRequirementRenderer($requirementRenderer): void
    {
        $this->requirementRenderer = $requirementRenderer;
    }

    public function render(Map $map): string
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        $options = $map->getMapOptions();
        unset($options['mapTypeId']);

        if (!$map->isAutoZoom()) {
            if (!isset($options['zoom'])) {
                $options['zoom'] = 3;
            }
        } else {
            unset($options['zoom']);
        }

        $this->controlManagerRenderer->render($map->getControlManager(), $jsonBuilder);

        $jsonBuilder
            ->setValue(
                '[mapTypeId]',
                $this->mapTypeIdRenderer->render($map->getMapOption('mapTypeId') ?: MapTypeId::ROADMAP),
                false
            )
            ->setValues($options);

        return $formatter->renderObjectAssignment($map, $formatter->renderObject('Map', [
            $formatter->renderCall(
                $formatter->renderProperty('document', 'getElementById'),
                [$formatter->renderEscape($map->getHtmlId())]
            ),
            $jsonBuilder->build(),
        ]));
    }

    public function renderRequirement(): string
    {
        return $this->requirementRenderer->render($this->getFormatter()->renderClass());
    }
}
