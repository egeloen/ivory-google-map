<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Extension;

/**
 * Abstract extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractExtensionHelper implements ExtensionHelperInterface
{
    /**
     * Renders a library.
     *
     * @param string      $source   The library source.
     * @param string|null $callback The javascript callback.
     *
     * @return string The HTML output.
     */
    protected function renderLibrary($source, $callback = null)
    {
        if ($callback === null) {
            return sprintf('<script type="text/javascript" src="%s"></script>'.PHP_EOL, $source);
        }

        $output = array();

        $output[] = 'var s = document.createElement("script");'.PHP_EOL;
        $output[] = 's.type = "text/javascript";'.PHP_EOL;
        $output[] = 's.async = true;'.PHP_EOL;
        $output[] = sprintf('s.src = "%s";'.PHP_EOL, $source);
        $output[] = sprintf('s.addEventListener("load", function () { %s(); }, false);'.PHP_EOL, $callback);
        $output[] = 'document.getElementsByTagName("head")[0].appendChild(s);'.PHP_EOL;

        return implode('', $output);
    }
}
