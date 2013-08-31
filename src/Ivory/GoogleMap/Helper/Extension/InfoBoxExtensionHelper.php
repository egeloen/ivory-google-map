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
class InfoBoxExtensionHelper implements ExtensionHelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function renderLibraries(Map $map)
    {
        $url = '//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js';
        return sprintf('<script type="text/javascript" src="%s"></script>'.PHP_EOL, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function renderBefore(Map $map)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function renderAfter(Map $map)
    {

    }
}
