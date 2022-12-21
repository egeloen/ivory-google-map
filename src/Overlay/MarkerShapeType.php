<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
final class MarkerShapeType
{
    public const POLY = 'poly';
    public const CIRCLE = 'circle';
    public const RECTANGLE = 'rect';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
