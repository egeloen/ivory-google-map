<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper;

/**
 * Google Map API helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelper extends AbstractHelper
{
    /** @var boolean */
    protected $loaded;

    /**
     * Creates a Google Map API helper.
     */
    public function __construct()
    {
        parent::__construct();

        $this->loaded = false;
    }

    /**
     * Checks/Sets if the API is already loaded.
     *
     * @param boolean $loaded TRUE if the API is already loaded else FALSE.
     *
     * @return boolean TRUE if the API is already loaded else FALSE.
     */
    public function isLoaded($loaded = null)
    {
        if ($loaded !== null) {
            $this->loaded = (bool) $loaded;
        }

        return $this->loaded;
    }

    /**
     * Renders the API.
     *
     * @param string  $language  The language.
     * @param array   $libraries Additionnal libraries.
     * @param string  $callback  A JS callback.
     * @param boolean $sensor    The sensor flag.
     *
     * @return string The HTML output.
     */
    public function render(
        $language = 'en',
        array $libraries = array(),
        $callback = null,
        $sensor = false
    )
    {
        $otherParameters = array();

        if (!empty($libraries)) {
            $otherParameters['libraries'] = implode(',', $libraries);
        }

        $otherParameters['language'] = $language;
        $otherParameters['sensor'] = json_encode((bool) $sensor);

        $this->jsonBuilder
            ->reset()
            ->setValue('[other_params]', urldecode(http_build_query($otherParameters)));

        if ($callback !== null) {
            $this->jsonBuilder->setValue('[callback]', $callback, false);
        }

        $callbackFunction = 'load_ivory_google_map_api';
        $url = sprintf('//www.google.com/jsapi?callback=%s', $callbackFunction);
        $loader = sprintf('google.load("maps", "3", %s);', $this->jsonBuilder->build());

        $output = array();
        $output[] = '<script type="text/javascript">'.PHP_EOL;
        $output[] = sprintf('function %s () { %s };'.PHP_EOL, $callbackFunction, $loader);
        $output[] = '</script>'.PHP_EOL;
        $output[] = sprintf('<script type="text/javascript" src="%s"></script>'.PHP_EOL, $url);

        $this->loaded = true;

        return implode('', $output);
    }
}
