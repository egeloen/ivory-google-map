<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\AbstractService;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Elevation extends AbstractService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/elevation');
    }

    /**
     * @param ElevationRequestInterface $request
     *
     * @return ElevationResponse
     */
    public function process(ElevationRequestInterface $request)
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

        return $this->getXmlParser()->parse($data);
    }

    /**
     * @param mixed[] $data
     *
     * @return ElevationResponse
     */
    private function buildResponse(array $data)
    {
        $response = new ElevationResponse();
        $response->setStatus($data['status']);
        $response->setResults($this->buildResults($data['results']));

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return ElevationResult[]
     */
    private function buildResults(array $data)
    {
        $results = [];

        foreach ($data as $result) {
            $results[] = $this->buildResult($result);
        }

        return $results;
    }

    /**
     * @param mixed[] $data
     *
     * @return ElevationResult
     */
    private function buildResult(array $data)
    {
        $element = new ElevationResult();
        $element->setLocation($this->buildCoordinate($data['location']));
        $element->setElevation($data['elevation']);

        if (isset($data['resolution'])) {
            $element->setResolution($data['resolution']);
        }

        return $element;
    }

    /**
     * @param mixed[] $data
     *
     * @return Coordinate
     */
    private function buildCoordinate(array $data)
    {
        return new Coordinate($data['lat'], $data['lng']);
    }
}
