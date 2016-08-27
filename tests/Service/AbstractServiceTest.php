<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service;

use Http\Adapter\Guzzle6\Client;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var CacheItemPoolInterface
     */
    private $pool;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pool = new FilesystemAdapter('', 0, __DIR__.'/.cache');
        $this->messageFactory = new GuzzleMessageFactory();

        $this->client = new PluginClient(new Client(), [
            new ErrorPlugin(),
            new RedirectPlugin(),
            new CachePlugin(
                $this->pool,
                new GuzzleStreamFactory(),
                [
                    'cache_lifetime'        => null,
                    'default_ttl'           => null,
                    'respect_cache_headers' => false,
                ]
            ),
        ]);
    }

    /**
     * @return HttpClient
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @return MessageFactory
     */
    protected function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @return CacheItemPoolInterface
     */
    protected function getPool()
    {
        return $this->pool;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return \DateTime
     */
    protected function getDateTime($key, $value = 'now')
    {
        $item = $this->pool->getItem(sha1(get_class().'::'.$key));

        if (!$item->isHit()) {
            $item->set(new \DateTime($value));
            $this->pool->save($item);
        }

        return $item->get();
    }
}
