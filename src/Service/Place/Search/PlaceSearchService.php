<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Search;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Place\AbstractPlaceParsableService;
use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRequestInterface;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponse;
use Ivory\GoogleMap\Service\Place\Search\Response\PlaceSearchResponseIterator;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceSearchService extends AbstractPlaceParsableService
{
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
     * @param PlaceSearchRequestInterface $request
     *
     * @return PlaceSearchResponseIterator
     */
    public function process(PlaceSearchRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $data = $this->parse((string) $httpResponse->getBody(), [
            'pluralization_rules' => [
                'html_attribution' => 'html_attributions',
                'photo'            => 'photos',
                'result'           => 'results',
                'type'             => 'types',
            ],
        ]);

        $response = $this->buildResponse($data);
        $response->setRequest($request);

        return new PlaceSearchResponseIterator($this, $response);
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceSearchResponse
     */
    private function buildResponse(array $data)
    {
        $response = new PlaceSearchResponse();
        $response->setStatus($data['status']);
        $response->setResults($this->buildResults($data['results']));

        if (isset($data['html_attributions'])) {
            $response->setHtmlAttributions($data['html_attributions']);
        }

        if (isset($data['next_page_token'])) {
            $response->setNextPageToken($data['next_page_token']);
        }

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return Place[]
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
     * @return Place
     */
    private function buildResult(array $data)
    {
        $result = new Place();
        $result->setPlaceId($data['place_id']);
        $result->setGeometry($this->buildGeometry($data['geometry']));

        if (isset($data['name'])) {
            $result->setName($data['name']);
        }

        if (isset($data['formatted_address'])) {
            $result->setFormattedAddress($data['formatted_address']);
        }

        if (isset($data['icon'])) {
            $result->setIcon($data['icon']);
        }

        if (isset($data['scope'])) {
            $result->setScope($data['scope']);
        }

        if (isset($data['price_level'])) {
            $result->setPriceLevel($data['price_level']);
        }

        if (isset($data['rating'])) {
            $result->setRating($data['rating']);
        }

        if (isset($data['vicinity'])) {
            $result->setVicinity($data['vicinity']);
        }

        if (isset($data['permanently_closed'])) {
            $result->setPermanentlyClose($data['permanently_closed']);
        }

        if (isset($data['types'])) {
            $result->setTypes($data['types']);
        }

        if (isset($data['photos'])) {
            $result->setPhotos($this->buildPhotos($data['photos']));
        }

        if (isset($data['alt_ids'])) {
            $result->setAlternatePlaceIds($this->buildAlternativePlaceIds($data['alt_ids']));
        }

        if (isset($data['opening_hours'])) {
            $result->setOpeningHours($this->buildOpeningHours($data['opening_hours']));
        }

        return $result;
    }

    /**
     * @param mixed[] $data
     *
     * @return Photo[]
     */
    private function buildPhotos(array $data)
    {
        $photos = [];

        foreach ($data as $photo) {
            $photos[] = $this->buildPhoto($photo);
        }

        return $photos;
    }

    /**
     * @param mixed[] $data
     *
     * @return Photo
     */
    private function buildPhoto(array $data)
    {
        $photo = new Photo();
        $photo->setReference($data['photo_reference']);
        $photo->setWidth($data['width']);
        $photo->setHeight($data['height']);
        $photo->setHtmlAttributions($data['html_attributions']);

        return $photo;
    }

    /**
     * @param mixed[] $data
     *
     * @return AlternatePlaceId[]
     */
    private function buildAlternativePlaceIds(array $data)
    {
        $alternativePlaceIds = [];

        foreach ($data as $alternativePlaceId) {
            $alternativePlaceIds[] = $this->buildAlternativePlaceId($alternativePlaceId);
        }

        return $alternativePlaceIds;
    }

    /**
     * @param mixed[] $data
     *
     * @return AlternatePlaceId
     */
    private function buildAlternativePlaceId(array $data)
    {
        $alternativePlaceId = new AlternatePlaceId();
        $alternativePlaceId->setPlaceId($data['place_id']);
        $alternativePlaceId->setScope($data['scope']);

        return $alternativePlaceId;
    }

    /**
     * @param mixed[] $data
     *
     * @return Geometry
     */
    private function buildGeometry(array $data)
    {
        $geometry = new Geometry();
        $geometry->setLocation($this->buildCoordinate($data['location']));

        return $geometry;
    }

    /**
     * @param array $data
     *
     * @return OpeningHours
     */
    private function buildOpeningHours(array $data)
    {
        $openingHours = new OpeningHours();
        $openingHours->setOpenNow($data['open_now']);

        return $openingHours;
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
