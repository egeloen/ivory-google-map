<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\TimeZone;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\TimeZone\Request\TimeZoneRequestInterface;
use Ivory\GoogleMap\Service\TimeZone\Response\TimeZoneResponse;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneService extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, Parser $parser = null)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/timezone', $parser);
    }

    /**
     * {@inheritdoc}
     */
    public function setHttps($https)
    {
        if (!$https) {
            throw new \InvalidArgumentException('The http scheme is not supported.');
        }

        parent::setHttps($https);
    }

    /**
     * @param TimeZoneRequestInterface $request
     *
     * @return TimeZoneResponse
     */
    public function process(TimeZoneRequestInterface $request)
    {
        $response = $this->getClient()->sendRequest($this->createRequest($request->build()));
        $data = $this->parse((string) $response->getBody(), ['snake_to_camel' => true]);

        return $this->buildResponse($data);
    }

    /**
     * @param mixed[] $data
     *
     * @return TimeZoneResponse
     */
    private function buildResponse(array $data)
    {
        $response = new TimeZoneResponse();
        $response->setStatus($data['status']);
        $response->setDstOffset((int) $data['dstOffset']);
        $response->setRawOffset((int) $data['rawOffset']);
        $response->setTimeZoneId($data['timeZoneId']);
        $response->setTimeZoneName($data['timeZoneName']);

        return $response;
    }
}
