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
class LoaderRenderer extends AbstractJsonRenderer
{
    /**
     * @param string   $name
     * @param string   $callback
     * @param string   $language
     * @param string[] $libraries
     * @param bool     $newLine
     *
     * @return string
     */
    public function render(
        $name,
        $callback,
        $language,
        array $libraries = [],
        $newLine = true
    ) {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        $parameters = ['language' => $language];
        if (!empty($libraries)) {
            $parameters['libraries'] = implode(',', $libraries);
        }

        $jsonBuilder
            ->setValue('[other_params]', urldecode(http_build_query($parameters, '', '&')))
            ->setValue('[callback]', $callback, false);

        return $formatter->renderClosure($formatter->renderCall($formatter->renderProperty('google', 'load'), [
            $formatter->renderEscape('maps'),
            $formatter->renderEscape('3'),
            $jsonBuilder->build(),
        ]), [], $name, true, $newLine);
    }

    /**
     * @param string $callback
     *
     * @return string
     */
    public function renderSource($callback)
    {
        return 'https://www.google.com/jsapi?callback='.$callback;
    }
}
