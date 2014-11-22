<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Renderers\Overlays;

/**
 * Info box renderer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxRenderer extends AbstractInfoWindowRenderer
{
    /**
     * Renders an info box source.
     *
     * @return string The info box source.
     */
    public function renderSource()
    {
        return '//google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js';
    }

    /**
     * {@inheritdoc}
     */
    protected function doRender()
    {
        return sprintf('new InfoBox(%s)', $this->getJsonBuilder()->build());
    }
}
