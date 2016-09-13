<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Overlay;

use Ivory\GoogleMap\Overlay\InfoWindowType;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class MarkerInfoBoxFunctionalTest extends AbstractMarkerInfoWindowFunctionalTest
{
    /**
     * {@inheritdoc}
     */
    protected function createInfoWindowMarker()
    {
        $infoWindow = parent::createInfoWindowMarker();
        $infoWindow->setType(InfoWindowType::INFO_BOX);

        return $infoWindow;
    }
}
