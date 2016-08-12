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

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TagRenderer extends AbstractRenderer
{
    /**
     * @param string      $name
     * @param string|null $code
     * @param string[]    $attributes
     * @param bool        $newLine
     *
     * @return string
     */
    public function render($name, $code = null, array $attributes = [], $newLine = true)
    {
        $formatter = $this->getFormatter();

        $tagAttributes = [];
        foreach ($attributes as $attribute => $value) {
            $tagAttributes[] = $attribute.'='.$formatter->renderEscape($value);
        }

        if (!empty($tagAttributes)) {
            array_unshift($tagAttributes, null);
        }

        return $formatter->renderLines([
            '<'.$name.implode(' ', $tagAttributes).'>',
            $formatter->renderIndentation($code),
            '</'.$name.'>',
        ], !empty($code), $newLine);
    }
}
