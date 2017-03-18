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

use Ivory\GoogleMap\Service\Plugin\Scaler\Context\Context;
use Ivory\GoogleMap\Service\Plugin\Scaler\Context\ContextInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ChainScaler implements ScalerInterface
{
    /**
     * @var ScalerInterface[]
     */
    private $scalers = [];

    /**
     * @param ScalerInterface[] $scalers
     */
    public function __construct(array $scalers)
    {
        $this->scalers = $scalers;
    }

    /**
     * @param ContextInterface $context
     *
     * @return ChainScaler
     */
    public static function create(ContextInterface $context = null)
    {
        $context = $context ?: new Context();

        return new static([
            new DirectionScaler($context),
            new DistanceMatrixScaler($context),
            new ElevationScaler($context),
            new GeocoderScaler($context),
            new PlaceAutocompleteScaler($context),
            new PlaceDetailScaler($context),
            new PlaceNearBySearchScaler($context),
            new PlaceRadarSearchScaler($context),
            new PlaceTextSearchScaler($context),
            new PlacePageTokenSearchScaler($context),
            new TimeZoneScaler($context),
            new SharedScaler($context),
        ]);
    }

    /**
     * @return ScalerInterface[]
     */
    public function getScalers()
    {
        return $this->scalers;
    }

    /**
     * {@inheritdoc}
     */
    public function scaleRequest(RequestInterface $request)
    {
        $scalers = $this->resolveScalers($uri = $request->getUri());

        if (empty($scalers)) {
            throw new \InvalidArgumentException(sprintf('No scalers supports the URI "%s".', (string) $uri));
        }

        $scale = 0;

        foreach ($scalers as $scaler) {
            $scale += $scaler->scaleRequest($request);
        }

        return $scale;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(UriInterface $url)
    {
        $scalers = $this->resolveScalers($url);

        return !empty($scalers);
    }

    /**
     * @param UriInterface $uri
     *
     * @return ScalerInterface[]
     */
    private function resolveScalers(UriInterface $uri)
    {
        $scalers = [];

        foreach ($this->scalers as $scaler) {
            if ($scaler->supports($uri)) {
                $scalers[] = $scaler;
            }
        }

        return $scalers;
    }
}
