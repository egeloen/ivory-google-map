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
class StylesheetRenderer extends AbstractRenderer
{
    /**
     * @param string $stylesheet
     * @param string $value
     *
     * @return string
     */
    public function render($stylesheet, $value)
    {
        $formatter = $this->getFormatter();

        return $formatter->renderCode($stylesheet.':'.$formatter->renderSeparator().$value, true, false);
    }
}
