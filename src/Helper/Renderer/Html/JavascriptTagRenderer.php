<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Html;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class JavascriptTagRenderer extends AbstractTagRenderer
{
    /**
     * @param string|null $code
     * @param string[]    $attributes
     * @param bool        $newLine
     *
     * @return string
     */
    public function render($code = null, array $attributes = [], $newLine = true)
    {
        return $this->getTagRenderer()->render(
            'script',
            $code,
            array_merge(['type' => 'text/javascript'], $attributes),
            $newLine
        );
    }
}
