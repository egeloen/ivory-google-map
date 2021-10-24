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
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Validaide\Common\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxRenderer extends AbstractInfoWindowRenderer
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

    public function renderSource(): string
    {
        return 'https://cdn.rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox_packed.js';
    }

    public function renderRequirement(): string
    {
        return $this->requirementRenderer->render($this->getClass());
    }

    protected function getClass(): string
    {
        return 'InfoBox';
    }

    protected function getNamespace(): bool
    {
        return false;
    }
}
