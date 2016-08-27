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
use Ivory\GoogleMap\Service\AbstractParsableService;
use Ivory\GoogleMap\Service\Elevation\Request\ElevationRequestInterface;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResponse;
use Ivory\GoogleMap\Service\Elevation\Response\ElevationResult;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ElevationService extends AbstractParsableService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, Parser $parser = null)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/elevation', $parser);
    }

    /**
     * @param ElevationRequestInterface $request
     *
     * @return ElevationResponse
     */
    public function process(ElevationRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $data = $this->parse((string) $httpResponse->getBody());

        $response = $this->buildResponse($data);
        $response->setRequest($request);

        return $response;
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
