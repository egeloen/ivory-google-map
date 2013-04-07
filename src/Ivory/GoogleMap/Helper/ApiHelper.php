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
class ApiHelper
{
    /** @var boolean */
    protected $loaded;

    /**
     * Creates a Google Map API helper.
     */
    public function __construct()
    {
        $this->loaded = false;
    }

    /**
     * Checks if the API is already loaded.
     *
     * @return boolean TRUE if the API is already loaded else FALSE.
     */
    public function isLoaded()
    {
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
        $this->loaded = true;

        $otherParameters = !empty($libraries) ? sprintf('libraries=%s&', implode(',', $libraries)) : null;
        $otherParameters .= sprintf('sensor=%s', $sensor ? 'true' : 'false');

        $options = array(
            'language'     => $language,
            'other_params' => $otherParameters,
        );

        $jsonOptions = substr(json_encode($options), 0, -1);

        if ($callback !== null) {
            $jsonOptions .= sprintf(', "callback": %s}', $callback);
        } else {
            $jsonOptions .= '}';
        }

        $loader = sprintf('google.load("maps", "3", %s);', $jsonOptions);

        $output = array();
        $output[] = '<script type="text/javascript">'.PHP_EOL;
        $output[] = sprintf('function load_ivory_google_map_api () { %s };'.PHP_EOL, $loader);
        $output[] = '</script>'.PHP_EOL;

        $output[] = sprintf(
            '<script type="text/javascript" src="%s"></script>'.PHP_EOL,
            '//www.google.com/jsapi?callback=load_ivory_google_map_api'
        );

        return implode('', $output);
    }
}
