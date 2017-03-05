<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Plugin\Scaler\Context;

use Psr\Http\Message\UriInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ContextInterface
{
    const CONTEXT_KEY = 1;
    const CONTEXT_SERVICE = 2;

    /**
     * @param UriInterface|null $uri
     * @param float|null        $since
     * @param int               $flag
     *
     * @return float[]
     */
    public function getTimes(
        UriInterface $uri = null,
        $since = null,
        $flag = self::CONTEXT_KEY | self::CONTEXT_SERVICE
    );

    /**
     * @param UriInterface $uri
     * @param float        $time
     * @param int          $coefficient
     */
    public function addTime(UriInterface $uri, $time, $coefficient = 1);
}
