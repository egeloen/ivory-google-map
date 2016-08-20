<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation\Request;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ElevationRequestInterface
{
    /**
     * @return mixed[]
     */
    public function build();
}
