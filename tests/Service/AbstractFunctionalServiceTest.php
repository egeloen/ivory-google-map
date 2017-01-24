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
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Ivory\Tests\GoogleMap\Service\Utility\Journal;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFunctionalServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Journal
     */
    protected static $journal;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var CacheItemPoolInterface
     */
    protected $pool;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        if (self::$journal === null) {
            self::$journal = new Journal();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (isset($_SERVER['RESET_CACHE']) && $_SERVER['RESET_CACHE']) {
            sleep(2);
        }

        $this->pool = new FilesystemAdapter('', 0, __DIR__.'/.cache');
        $this->messageFactory = new GuzzleMessageFactory();

        $this->client = new PluginClient(new Client(), [
            new ErrorPlugin(),
            new HistoryPlugin(self::$journal),
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
