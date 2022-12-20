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

use DateTime;
use Http\Adapter\Guzzle6\Client;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\Plugin\ErrorPlugin as HttpErrorPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\PluginClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Message\StreamFactory\GuzzleStreamFactory;
use Ivory\GoogleMap\Service\Plugin\ErrorPlugin;
use Ivory\Tests\GoogleMap\Service\Utility\Journal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFunctionalServiceTest extends TestCase
{
    protected static ?Journal $journal = null;

    protected PluginClient $client;

    protected GuzzleMessageFactory $messageFactory;

    protected FilesystemAdapter $pool;

    public static function setUpBeforeClass(): void
    {
        if (self::$journal === null) {
            self::$journal = new Journal();
        }
    }

    protected function setUp(): void
    {
        if (isset($_SERVER['CACHE_RESET']) && $_SERVER['CACHE_RESET']) {
            sleep(2);
        }

        $this->pool   = new FilesystemAdapter('', 0, $_SERVER['CACHE_PATH']);
        $this->client = new PluginClient(new Client(), [
            new HttpErrorPlugin(),
            new ErrorPlugin(),
            new HistoryPlugin(self::$journal),
            new CachePlugin(
                $this->pool,
                new GuzzleStreamFactory(),
                [
                    'cache_lifetime'                    => null,
                    'default_ttl'                       => null,
                    'respect_response_cache_directives' => [],
                ]
            ),
        ]);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return DateTime
     */
    protected function getDateTime($key, $value = 'now')
    {
        $item = $this->pool->getItem(sha1(get_class() . '::' . $key));

        if (!$item->isHit()) {
            $item->set(new DateTime($value));
            $this->pool->save($item);
        }

        return $item->get();
    }
}
