<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Plugin\Scaler;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ScalerInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return int
     */
    public function scaleRequest(RequestInterface $request);

    /**
     * @param UriInterface $url
     *
     * @return bool
     */
    public function supports(UriInterface $url);
}
