<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

use SplObjectStorage;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiInitRenderer extends AbstractRenderer
{
    /**
     * @param string           $name
     * @param string[]         $sources
     * @param string           $sourceCallback
     * @param string           $requirementCallback
     * @param bool             $newLine
     *
     */
    public function render($name, SplObjectStorage $callbacks, SplObjectStorage $requirements, array $sources, $sourceCallback, $requirementCallback, $newLine = true): string
    {
        $formatter = $this->getFormatter();
        $separator = $formatter->renderSeparator();
        $codes     = [];

        foreach ($sources as $source) {
            $codes[] = $formatter->renderCall($sourceCallback, [$formatter->renderEscape($source)], true);
        }

        foreach ($callbacks as $object) {
            $codes[] = $formatter->renderCall($requirementCallback, [
                $callbacks[$object],
                $formatter->renderClosure($formatter->renderCode(
                    'return ' . implode(
                        $separator . '&&' . $separator,
                        $requirements[$object] ?? []
                    ),
                    true,
                    false
                )),
            ], true);
        }


        return $formatter->renderClosure($formatter->renderLines($codes, true, false), [], $name, true, $newLine);
    }
}
