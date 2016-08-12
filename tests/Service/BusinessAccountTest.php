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

use Ivory\GoogleMap\Service\BusinessAccount;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BusinessAccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BusinessAccount
     */
    private $businessAccount;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->businessAccount = new BusinessAccount(
            $this->clientId = 'client_id',
            $this->secret = 'secret'
        );
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

        $this->assertSame($this->clientId, $this->businessAccount->getClientId());
        $this->assertSame($this->secret, $this->businessAccount->getSecret());
        $this->assertTrue($this->businessAccount->hasChannel());
        $this->assertSame($channel, $this->businessAccount->getChannel());
    }

    public function testClientId()
    {
        $this->businessAccount->setClientId($clientId = 'foo');

        $this->assertSame($clientId, $this->businessAccount->getClientId());
    }

    public function testSecret()
    {
        $this->businessAccount->setSecret($secret = 'foo');

        $this->assertSame($secret, $this->businessAccount->getSecret());
    }

    public function testChannel()
    {
        $this->businessAccount->setChannel($channel = 'foo');

        $this->assertTrue($this->businessAccount->hasChannel());
        $this->assertSame($channel, $this->businessAccount->getChannel());
    }

    public function testResetChannel()
    {
        $this->businessAccount->setChannel('foo');
        $this->businessAccount->setChannel(null);

        $this->assertFalse($this->businessAccount->hasChannel());
        $this->assertNull($this->businessAccount->getChannel());
    }

    /**
     * @param string      $url
     * @param string      $signature
     * @param string|null $channel
     *
     * @dataProvider signatureProvider
     */
    public function testSignature($url, $signature, $channel = null)
    {
        $expected = $url.'&client=gme-client_id';
        if ($channel !== null) {
            $expected .= '&channel='.$channel;
        }

        $this->businessAccount->setChannel($channel);

        $this->assertSame($expected.'&signature='.$signature, $this->businessAccount->signUrl($url));
    }

    /**
     * @return string[][]
     */
    public function signatureProvider()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        return [
            [$url, 'EO4W2ipM4YzwEIOM1pRZ5xbrl8k='],
            [$url, 'e9BFlnQaKg-t3NIxKbilkQeTU1Y=', 'channel'],
        ];
    }
}
