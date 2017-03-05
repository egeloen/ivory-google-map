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
class Context implements ContextInterface
{
    /**
     * @var float[][]
     */
    private $times;

    /**
     * @param float[][] $times
     */
    public function __construct(array $times = [])
    {
        $this->times = $times;
    }

    /**
     * {@inheritdoc}
     */
    public function getTimes(
        UriInterface $uri = null,
        $since = null,
        $flag = self::CONTEXT_KEY | self::CONTEXT_SERVICE
    ) {
        $times = $this->resolveTimes($uri, $flag);

        if ($since === null) {
            return $times;
        }

        foreach ($times as $offset => $time) {
            if ($time >= $since) {
                return array_slice($times, $offset);
            }
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function addTime(UriInterface $uri, $time, $coefficient = 1)
    {
        $key = $this->getKey($uri);
        $service = $this->getService($uri);

        for ($i = 0; $i < $coefficient; ++$i) {
            $this->times[$service][$key][] = $time;
        }
    }

    /**
     * @param UriInterface|null $uri
     * @param int               $flag
     *
     * @return float[]
     */
    private function resolveTimes(UriInterface $uri = null, $flag = self::CONTEXT_KEY | self::CONTEXT_SERVICE)
    {
        $times = $this->times;

        if ($uri !== null && ($flag & self::CONTEXT_SERVICE)) {
            $service = $this->getService($uri);
            $times = isset($times[$service]) ? $times[$service] : [];
        } else {
            $times = call_user_func_array('array_merge_recursive', $times);
        }

        if ($uri !== null && ($flag & self::CONTEXT_KEY)) {
            $key = $this->getKey($uri);
            $times = isset($times[$key]) ? $times[$key] : [];
        } else {
            $times = call_user_func_array('array_merge', $times);
        }

        asort($times);

        return array_values($times);
    }

    /**
     * @param UriInterface $uri
     *
     * @return string|null
     */
    private function getService(UriInterface $uri)
    {
        $url = (string) $uri;

        foreach (['/json', '/xml', '?'] as $delimiter) {
            if (($position = strpos($url, $delimiter)) !== false) {
                return substr($url, 0, $position);
            }
        }

        return $url;
    }

    /**
     * @param UriInterface $uri
     *
     * @return string|null
     */
    private function getKey(UriInterface $uri)
    {
        $url = (string) $uri;

        if (($startPosition = strpos($url, 'key=')) !== false) {
            $startPosition += 4;

            if (($lastPosition = strpos($url, '&', $startPosition)) !== false) {
                return substr($url, $startPosition, $lastPosition);
            }

            return substr($url, $startPosition);
        }
    }
}
