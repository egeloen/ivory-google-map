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

use Ivory\GoogleMap\Helpers\Renderers\AbstractJsonRenderer;

/**
 * Autocomplete container renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteContainerRenderer extends AbstractJsonRenderer
{
    /**
     * Renders an autocomplete container.
     *
     * @return string The rendered autocomplete container.
     */
    public function render()
    {
        return $this->getJsonBuilder()
            ->reset()
            ->setValue('[base][coordinates]', array())
            ->setValue('[base][bounds]', array())
            ->setValue('[autocomplete]', null)
            ->build();
    }
}
