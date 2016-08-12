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
class SourceRenderer extends AbstractRenderer
{
    /**
     * @param string      $name
     * @param string      $source
     * @param string|null $variable
     * @param bool        $newLine
     *
     * @return string
     */
    public function render($name, $source = null, $variable = null, $newLine = true)
    {
        $formatter = $this->getFormatter();
        $source = $source ?: 'src';
        $variable = $variable ?: 'script';

        return $formatter->renderClosure($formatter->renderLines([
            $formatter->renderAssignment(
                'var '.$variable,
                $formatter->renderCall(
                    $formatter->renderProperty('document', 'createElement'),
                    [$formatter->renderEscape('script')]
                ),
                true
            ),
            $formatter->renderAssignment(
                $formatter->renderProperty($variable, 'type'),
                $formatter->renderEscape('text/javascript'),
                true
            ),
            $formatter->renderAssignment(
                $formatter->renderProperty($variable, 'async'),
                $formatter->renderEscape(true),
                true
            ),
            $formatter->renderAssignment(
                $formatter->renderProperty($variable, 'src'),
                $source,
                true
            ),
            $formatter->renderCall(
                $formatter->renderProperty(
                    $formatter->renderCall(
                        $formatter->renderProperty('document', 'getElementsByTagName'),
                        [$formatter->renderEscape('head')]
                    ).'[0]',
                    'appendChild'
                ),
                [$variable],
                true
            ),
        ], true, false), [$source], $name, true, $newLine);
    }
}
