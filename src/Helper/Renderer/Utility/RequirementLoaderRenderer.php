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
class RequirementLoaderRenderer extends AbstractRenderer
{
    /**
     * @param string      $name
     * @param string|null $intervalVariable
     * @param string|null $callbackVariable
     * @param string|null $requirementVariable
     * @param int         $interval
     * @param bool        $newLine
     *
     * @return string
     */
    public function render(
        $name,
        $intervalVariable = null,
        $callbackVariable = null,
        $requirementVariable = null,
        $interval = 10,
        $newLine = true
    ) {
        $formatter = $this->getFormatter();

        $intervalVariable = $intervalVariable ?: 'i';
        $callbackVariable = $callbackVariable ?: 'c';
        $requirementVariable = $requirementVariable ?: 'r';

        return $formatter->renderClosure($this->renderRequirement(
            $intervalVariable,
            $callbackVariable,
            $requirementVariable,
            $formatter->renderStatement('else', $formatter->renderAssignment(
                'var '.$intervalVariable,
                $formatter->renderCall('setInterval', [
                    $formatter->renderClosure($this->renderRequirement(
                        $intervalVariable,
                        $callbackVariable,
                        $requirementVariable
                    )),
                    $interval,
                ], true)
            ), null, null, false)
        ), [$callbackVariable, $requirementVariable], $name, true, $newLine);
    }

    /**
     * @param string      $intervalVariable
     * @param string      $callbackVariable
     * @param string      $requirementVariable
     * @param string|null $nextStatement
     *
     * @return string
     */
    private function renderRequirement(
        $intervalVariable,
        $callbackVariable,
        $requirementVariable,
        $nextStatement = null
    ) {
        $formatter = $this->getFormatter();
        $codes = [$formatter->renderCall($callbackVariable, [], true)];

        if (empty($nextStatement)) {
            array_unshift($codes, $formatter->renderCall('clearInterval', [$intervalVariable], true));
        }

        return $formatter->renderStatement(
            'if',
            $formatter->renderLines($codes, true, false),
            $formatter->renderCall($requirementVariable),
            $nextStatement,
            false
        );
    }
}
