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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiInitRenderer extends AbstractRenderer
{
    /**
     * @param string            $name
     * @param \SplObjectStorage $callbacks
     * @param \SplObjectStorage $requirements
     * @param string[]          $sources
     * @param string            $sourceCallback
     * @param string            $requirementCallback
     * @param bool              $newLine
     *
     * @return string
     */
    public function render(
        $name,
        \SplObjectStorage $callbacks,
        \SplObjectStorage $requirements,
        array $sources,
        $sourceCallback,
        $requirementCallback,
        $newLine = true
    ) {
        $formatter = $this->getFormatter();
        $separator = $formatter->renderSeparator();
        $codes = [];

        foreach ($sources as $source) {
            $codes[] = $formatter->renderCall($sourceCallback, [$formatter->renderEscape($source)], true);
        }

        foreach ($callbacks as $object) {
            $codes[] = $formatter->renderCall($requirementCallback, [
                $callbacks[$object],
                $formatter->renderClosure($formatter->renderCode(
                    'return '.implode(
                        $separator.'&&'.$separator,
                        isset($requirements[$object]) ? $requirements[$object] : []
                    ),
                    true,
                    false
                )),
            ], true);
        }

        return $formatter->renderClosure($formatter->renderLines($codes, true, false), [], $name, true, $newLine);
    }
}
