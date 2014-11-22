<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services;

use Ivory\GoogleMap\Services\BusinessAccount;

/**
 * Business account test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BusinessAccountTest extends AbstractTestCase
{
    /** @var \Ivory\GoogleMap\Services\BusinessAccount */
    private $businessAccount;

    /** @var string */
    private $clientId;

    /** @var string */
    private $secret;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->businessAccount = new BusinessAccount($this->clientId = 'client_id', $this->secret = 'secret');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->secret);
        unset($this->clientId);
        unset($this->businessAccount);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->clientId, $this->businessAccount->getClientId());
        $this->assertSame($this->secret, $this->businessAccount->getSecret());
        $this->assertFalse($this->businessAccount->hasChannel());
        $this->assertNull($this->businessAccount->getChannel());
    }

    public function testInitialState()
    {
        $this->businessAccount = new BusinessAccount($this->clientId, $this->secret, $channel = 'channel');

        $this->assertTrue($this->businessAccount->hasChannel());
        $this->assertSame($channel, $this->businessAccount->getChannel());
    }

    public function testSetClientId()
    {
        $this->businessAccount->setClientId($clientId = 'foo');

        $this->assertSame($clientId, $this->businessAccount->getClientId());
    }

    public function testSetSecret()
    {
        $this->businessAccount->setSecret($secret = 'foo');

        $this->assertSame($secret, $this->businessAccount->getSecret());
    }

    public function testSetChannel()
    {
        $this->businessAccount->setChannel($channel = 'foo');

        $this->assertSame($channel, $this->businessAccount->getChannel());
    }

    /**
     * @dataProvider signUrlProvider
     */
    public function testSignUrl($url, $channel, $signature)
    {
        $this->businessAccount->setChannel($channel);

        $this->assertSame($url.$signature, $this->businessAccount->signUrl($url));
    }

    /**
     * Gets the sign url provider.
     *
     * @return array The sign url provider.
     */
    public function signUrlProvider()
    {
        return array(
            array(
                'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false',
                null,
                '&client=gme-client_id&signature=EO4W2ipM4YzwEIOM1pRZ5xbrl8k=',
            ),
            array(
                'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false',
                'channel',
                '&client=gme-client_id&channel=channel&signature=e9BFlnQaKg-t3NIxKbilkQeTU1Y=',
            ),
        );
    }
}
