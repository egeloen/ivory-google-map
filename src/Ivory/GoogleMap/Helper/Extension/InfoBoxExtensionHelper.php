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

use Ivory\GoogleMap\Map;

/**
 * InfoBox extension helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxExtensionHelper extends AbstractExtensionHelper
{
    /** @var string */
    protected $source;

    /** @var string */
    protected $callback;

    /**
     * Creates an info box extension helper.
     *
     * @param string $source   The info box source URL.
     * @param string $callback The info box callback.
     */
    public function __construct(
        $source = '//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js',
        $callback = 'load_ivory_google_map_info_box'
    ) {
        $this->setSource($source);
        $this->setCallback($callback);
    }

    /**
     * Gets the info box source URL.
     *
     * @return string The info box source URL.
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets the info box source URL.
     *
     * @param string $source The info box source URL.
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Gets the javascript callback.
     *
     * @return string The javascript callback.
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Sets the javascript callback.
     *
     * @param string $callback The javascript callback.
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(Map $map)
    {
        if (!$map->isAsync()) {
            return $this->renderLibrary($this->source);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderBefore(Map $map)
    {
        if ($map->isAsync()) {
            return sprintf('function %s () {'.PHP_EOL, $this->callback);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderAfter(Map $map)
    {
        if ($map->isAsync()) {
            return '}'.PHP_EOL.$this->renderLibrary($this->source, $this->callback);
        }
    }
}
