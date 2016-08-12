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

use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHtmlRenderer extends AbstractTagRenderer
{
    /**
     * @param Autocomplete $autocomplete
     *
     * @return string
     */
    public function render(Autocomplete $autocomplete)
    {
        $attributes = [
            'id'           => $autocomplete->getHtmlId(),
            'type'         => 'text',
            'autocomplete' => 'off',
        ];

        if ($autocomplete->hasValue()) {
            $attributes['value'] = $autocomplete->getValue();
        }

        return $this->getTagRenderer()->render('input', null, array_merge(
            $attributes,
            $autocomplete->getInputAttributes()
        ));
    }
}
