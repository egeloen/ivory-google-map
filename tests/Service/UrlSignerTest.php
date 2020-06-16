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

use Ivory\GoogleMap\Service\UrlSigner;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class UrlSignerTest extends TestCase
{
    /**
     * @param string      $expected
     * @param string      $url
     * @param string      $secret
     * @param string|null $clientId
     * @param string|null $channel
     *
     * @dataProvider signatureProvider
     */
    public function testSignature($expected, $url, $secret, $clientId = null, $channel = null)
    {
        $signedUrl = $url;

        if ($clientId !== null) {
            $signedUrl .= '&client=gme-'.$clientId;
        }

        if ($channel !== null) {
            $signedUrl .= '&channel='.$channel;
        }

        $this->assertSame($signedUrl.'&signature='.$expected, UrlSigner::sign($url, $secret, $clientId, $channel));
    }

    /**
     * @return mixed[]
     */
    public function signatureProvider()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        return [
            ['AClucwfQ8ZcYlmcD44NFn7ttlVw=', $url, 'secret'],
            ['EO4W2ipM4YzwEIOM1pRZ5xbrl8k=', $url, 'secret', 'client_id'],
            ['e9BFlnQaKg-t3NIxKbilkQeTU1Y=', $url, 'secret', 'client_id', 'channel'],
        ];
    }
}
