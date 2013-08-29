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
 * Extension helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ExtensionHelperInterface
{
    /**
     * Renders libraires.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The html output.
     */
    public function renderLibraries(Map $map);

    /**
     * Renders JS code just before the generated one.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderBefore(Map $map);

    /**
     * Renders JS code just after the generated one.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderAfter(Map $map);
}
