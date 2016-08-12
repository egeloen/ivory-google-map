<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Utility;

use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RequirementRenderer extends AbstractRenderer
{
    /**
     * @param string $class
     *
     * @return string
     */
    public function render($class)
    {
        $separator = $this->getFormatter()->renderSeparator();

        return 'typeof '.$class.$separator.'!=='.$separator.'typeof undefined';
    }
}
