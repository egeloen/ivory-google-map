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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneService extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/timezone');
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
        $data = $this->parse((string) $response->getBody());

        return $this->buildResponse($data);
    }

    /**
     * @param string $data
     *
     * @return mixed[]
     */
    private function parse($data)
    {
        if ($this->getFormat() === self::FORMAT_JSON) {
            return json_decode($data, true);
        }

        return $this->getXmlParser()->parse($data, [], true);
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
