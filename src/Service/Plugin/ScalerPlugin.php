<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Plugin;

use Http\Client\Common\Plugin;
use Ivory\GoogleMap\Service\Plugin\Scaler\ChainScaler;
use Ivory\GoogleMap\Service\Plugin\Scaler\ScalerInterface;
use Psr\Http\Message\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScalerPlugin implements Plugin
{
    /**
     * @var ScalerInterface
     */
    private $scaler;

    /**
     * @param ScalerInterface|null $scaler
     */
    public function __construct(ScalerInterface $scaler = null)
    {
        $this->scaler = $scaler ?: ChainScaler::create();
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        if ($this->scaler->supports($request->getUri())) {
            $this->scaler->scaleRequest($request);
        }

        return $next($request);
    }
}
