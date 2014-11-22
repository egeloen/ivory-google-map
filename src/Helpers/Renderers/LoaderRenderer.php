<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers;

/**
 * Loader renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LoaderRenderer extends AbstractJsonRenderer
{
    /**
     * Renders the loader.
     *
     * @param string      $language  The language
     * @param array       $libraries The libraries.
     * @param string|null $callback  The callback.
     * @param boolean     $sensor    TRUE if the sensor is enabled else FALSE.
     *
     * @return string The rendered loader.
     */
    public function render($language, array $libraries = array(), $callback = null, $sensor = false)
    {
        $parameters = array();

        if (!empty($libraries)) {
            $parameters['libraries'] = implode(',', $libraries);
        }

        $parameters['language'] = $language;
        $parameters['sensor'] = $sensor ? 'true' : 'false';

        $this->getJsonBuilder()
            ->reset()
            ->setValue('[other_params]', urldecode(http_build_query($parameters)));

        if ($callback !== null) {
            $this->getJsonBuilder()->setValue('[callback]', $callback, false);
        }

        return sprintf('google.load("maps","3",%s)', $this->getJsonBuilder()->build());
    }

    /**
     * Renders the source.
     *
     * @param string $callback The callback.
     *
     * @return string The rendered source.
     */
    public function renderSource($callback)
    {
        return '//www.google.com/jsapi?callback='.$callback;
    }
}
