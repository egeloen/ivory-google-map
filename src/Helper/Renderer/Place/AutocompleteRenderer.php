<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Place;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractJsonRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteRenderer extends AbstractJsonRenderer
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

    public function render(Autocomplete $autocomplete): string
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        if ($autocomplete->hasTypes()) {
            $jsonBuilder->setValue('[types]', $autocomplete->getTypes());
        }

        if ($autocomplete->hasBound()) {
            $jsonBuilder->setValue('[bounds]', $autocomplete->getBound()->getVariable(), false);
        }

        if ($autocomplete->hasComponents()) {
            $jsonBuilder->setValue('[componentRestrictions]', $autocomplete->getComponents());
        }

        if (!$jsonBuilder->hasValues()) {
            $jsonBuilder->setJsonEncodeOptions(JSON_FORCE_OBJECT);
        }

        return $formatter->renderObjectAssignment($autocomplete, $formatter->renderObject('Autocomplete', [
            $formatter->renderCall($formatter->renderProperty('document', 'getElementById'), [
                $formatter->renderEscape($autocomplete->getHtmlId()),
            ]),
            $jsonBuilder->build(),
        ], $formatter->renderClass('places')));
    }

    public function renderRequirement(): string
    {
        return $this->requirementRenderer->render($this->getFormatter()->renderClass('places'));
    }
}
