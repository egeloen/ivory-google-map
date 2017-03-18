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

use Ivory\GoogleMap\Service\Plugin\Scaler\Config\Config;
use Ivory\GoogleMap\Service\Plugin\Scaler\Config\ConfigInterface;
use Ivory\GoogleMap\Service\Plugin\Scaler\Context\ContextInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Scaler implements ScalerInterface
{
    /**
     * @var string[]
     */
    private $urls;

    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param string|string[]      $urls
     * @param ContextInterface     $context
     * @param ConfigInterface|null $config
     */
    public function __construct($urls, ContextInterface $context, ConfigInterface $config = null)
    {
        $this->urls = is_array($urls) ? $urls : [$urls];
        $this->context = $context;
        $this->config = $config ?: new Config();
    }

    /**
     * @return string[]
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @return ContextInterface
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * {@inheritdoc}
     */
    public function scaleRequest(RequestInterface $request)
    {
        $uri = $request->getUri();

        if (!$this->supports($uri)) {
            throw new \InvalidArgumentException(sprintf(
                'The "%s" does not support the url "%s".',
                get_class($this),
                (string) $uri
            ));
        }

        $since = microtime(true) - $this->config->getPeriod();
        $times = $this->context->getTimes($uri, $since, $this->config->getFlag());
        $scale = 0;

        if (count($times) >= ($queryPerPeriod = $this->config->getQueryPerPeriod())) {
            $times = array_slice($times, $queryPerPeriod * -1);
            usleep($scale = (int) ((reset($times) - $since) * 1000000));
        }

        $this->context->addTime($uri, microtime(true), $this->config->getCoefficient());

        return $scale;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(UriInterface $uri)
    {
        $url = (string) $uri;

        foreach ($this->urls as $baseUrl) {
            if (strpos($url, $baseUrl) === 0) {
                return true;
            }
        }

        return false;
    }
}
