<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class UrlSigner
{
    /**
     * @param string      $url
     * @param string      $secret
     * @param string|null $clientId
     * @param string|null $channel
     *
     * @return string
     */
    public static function sign($url, $secret, $clientId = null, $channel = null)
    {
        if ($clientId !== null) {
            $url .= '&client=gme-'.$clientId;
        }

        if ($channel !== null) {
            $url .= '&channel='.$channel;
        }

        $urlParts = parse_url($url);
        $data = $urlParts['path'].'?'.$urlParts['query'];
        $key = base64_decode(str_replace(['-', '_'], ['+', '/'], $secret));
        $signature = base64_encode(hash_hmac('sha1', $data, $key, true));

        return $url.'&signature='.str_replace(['+', '/'], ['-', '_'], $signature);
    }
}
