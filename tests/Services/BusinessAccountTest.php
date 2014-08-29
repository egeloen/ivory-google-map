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
class BusinessAccountTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\BusinessAccount */
    protected $businessAccount;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->businessAccount = new BusinessAccount('client_id', 'secret');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->businessAccount);
    }

    public function testDefaultState()
    {
        $this->assertSame('client_id', $this->businessAccount->getClientId());
        $this->assertSame('secret', $this->businessAccount->getSecret());
        $this->assertFalse($this->businessAccount->hasChannel());
        $this->assertNull($this->businessAccount->getChannel());
    }

    public function testInitialState()
    {
        $this->businessAccount = new BusinessAccount('client_id', 'secret', 'channel');

        $this->assertTrue($this->businessAccount->hasChannel());
        $this->assertSame('channel', $this->businessAccount->getChannel());
    }

    public function testClientId()
    {
        $this->businessAccount->setClientId('foo');

        $this->assertSame('foo', $this->businessAccount->getClientId());
    }

    public function testSecret()
    {
        $this->businessAccount->setSecret('foo');

        $this->assertSame('foo', $this->businessAccount->getSecret());
    }

    public function testChannel()
    {
        $this->businessAccount->setChannel('foo');

        $this->assertSame('foo', $this->businessAccount->getChannel());
    }

    public function testSignUrlWithoutChannel()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';
        $expected = $url.'&client=gme-client_id&signature=EO4W2ipM4YzwEIOM1pRZ5xbrl8k=';

        $this->assertSame($expected, $this->businessAccount->signUrl($url));
    }

    public function testSignUrlWithChannel()
    {
        $this->businessAccount->setChannel('channel');

        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';
        $expected = $url.'&client=gme-client_id&channel=channel&signature=e9BFlnQaKg-t3NIxKbilkQeTU1Y=';

        $this->assertSame($expected, $this->businessAccount->signUrl($url));
    }
}
