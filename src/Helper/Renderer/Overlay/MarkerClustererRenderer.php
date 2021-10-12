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
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\MarkerCluster;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClustererRenderer extends AbstractJsonRenderer
{
    private ?RequirementRenderer $requirementRenderer = null;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        RequirementRenderer $requirementRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setRequirementRenderer($requirementRenderer);
    }

    public function getRequirementRenderer(): RequirementRenderer
    {
        return $this->requirementRenderer;
    }

    public function setRequirementRenderer(RequirementRenderer $requirementRenderer): void
    {
        $this->requirementRenderer = $requirementRenderer;
    }

    /**
     * @param string        $markers
     *
     */
    public function render(MarkerCluster $markerCluster, Map $map, $markers): string
    {
        $options = $markerCluster->getOptions();

        if (!isset($options['imagePath'])) {
            $options['imagePath'] = 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m';
        }

        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder()->setValues($options);

        return $formatter->renderObjectAssignment($markerCluster, $formatter->renderObject('MarkerClusterer', [
            $map->getVariable(),
            $markers,
            $jsonBuilder->build(),
        ], false));
    }

    public function renderSource(): string
    {
        return 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/src/markerclusterer.js';
    }

    public function renderRequirement(): string
    {
        return $this->requirementRenderer->render('MarkerClusterer');
    }
}
