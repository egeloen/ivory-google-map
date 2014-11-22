<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Places;

use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Autocomplete renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteRenderer extends AbstractJsonRenderer
{
    /**
     * Renders an autocomplete.
     *
     * @param \Ivory\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The rendered autocomplete.
     */
    public function render(Autocomplete $autocomplete)
    {
        $this->getJsonBuilder()->reset();

        if ($autocomplete->hasTypes()) {
            $this->getJsonBuilder()->setValue('[types]', $autocomplete->getTypes());
        }

        if ($autocomplete->hasBound()) {
            $this->getJsonBuilder()->setValue('[bounds]', $autocomplete->getBound()->getVariable(), false);
        }

        if ($autocomplete->hasComponentRestrictions()) {
            $this->getJsonBuilder()->setValue('[componentRestrictions]', $autocomplete->getComponentRestrictions());
        }

        if (!$this->getJsonBuilder()->hasValues()) {
            $this->getJsonBuilder()->setJsonEncodeOptions(JSON_FORCE_OBJECT);
        }

        return sprintf(
            'new google.maps.places.Autocomplete(document.getElementById(\'%s\'),%s)',
            $autocomplete->getInputId(),
            $this->getJsonBuilder()->build()
        );
    }
}
