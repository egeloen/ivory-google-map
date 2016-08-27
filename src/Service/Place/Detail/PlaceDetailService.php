<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Detail;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\AbstractParsableService;
use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\AspectRating;
use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Base\Review;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Ivory\GoogleMap\Service\Place\Detail\Response\PlaceDetailResponse;
use Ivory\GoogleMap\Service\Utility\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailService extends AbstractParsableService
{
    /**
     * @param HttpClient     $client
     * @param MessageFactory $messageFactory
     * @param Parser|null    $parser
     */
    public function __construct(HttpClient $client, MessageFactory $messageFactory, Parser $parser = null)
    {
        parent::__construct($client, $messageFactory, 'http://maps.googleapis.com/maps/api/place/details', $parser);
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
     * @param PlaceDetailRequestInterface $request
     *
     * @return PlaceDetailResponse
     */
    public function process(PlaceDetailRequestInterface $request)
    {
        $httpRequest = $this->createRequest($request);
        $httpResponse = $this->getClient()->sendRequest($httpRequest);

        $data = $this->parse((string) $httpResponse->getBody(), [
            'pluralization_rules' => [
                'address_component' => 'address_components',
                'aspect'            => 'aspects',
                'html_attribution'  => 'html_attributions',
                'period'            => 'periods',
                'photo'             => 'photos',
                'type'              => 'types',
                'review'            => 'reviews',
            ],
        ]);

        $response = $this->buildResponse($data);
        $response->setRequest($request);

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return PlaceDetailResponse
     */
    private function buildResponse(array $data)
    {
        $response = new PlaceDetailResponse();
        $response->setStatus($data['status']);

        if (isset($data['result'])) {
            $response->setResult($this->buildResult($data['result']));
        }

        if (isset($data['html_attributions'])) {
            $response->setHtmlAttributions($data['html_attributions']);
        }

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return Place
     */
    private function buildResult(array $data)
    {
        $result = new Place();
        $result->setId($data['id']);
        $result->setPlaceId($data['place_id']);
        $result->setName($data['name']);
        $result->setFormattedAddress($data['formatted_address']);
        $result->setFormattedPhoneNumber($data['formatted_phone_number']);
        $result->setInternationalPhoneNumber($data['international_phone_number']);
        $result->setUrl($data['url']);
        $result->setIcon($data['icon']);
        $result->setScope($data['scope']);
        $result->setRating($data['rating']);
        $result->setUtcOffset($data['utc_offset']);
        $result->setVicinity($data['vicinity']);
        $result->setWebsite($data['website']);
        $result->setTypes($data['types']);
        $result->setAddressComponents($this->buildAddressComponents($data['address_components']));
        $result->setPhotos($this->buildPhotos($data['photos']));
        $result->setGeometry($this->buildGeometry($data['geometry']));
        $result->setOpeningHours($this->buildOpeningHours($data['opening_hours']));
        $result->setReviews($this->buildReviews($data['reviews']));

        if (isset($data['price_level'])) {
            $result->setPriceLevel($data['price_level']);
        }

        if (isset($data['permanently_closed'])) {
            $result->setPermanentlyClose($data['permanently_closed']);
        }

        if (isset($data['alt_ids'])) {
            $result->setAlternatePlaceIds($this->buildAlternativePlaceIds($data['alt_ids']));
        }

        return $result;
    }

    /**
     * @param mixed[] $data
     *
     * @return AddressComponent[]
     */
    private function buildAddressComponents(array $data)
    {
        $addressComponents = [];

        foreach ($data as $addressComponent) {
            $addressComponents[] = $this->buildAddressComponent($addressComponent);
        }

        return $addressComponents;
    }

    /**
     * @param mixed[] $data
     *
     * @return AddressComponent
     */
    private function buildAddressComponent(array $data)
    {
        $address = new AddressComponent();
        $address->setLongName($data['long_name']);
        $address->setShortName($data['short_name']);
        $address->setTypes($data['types']);

        return $address;
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
     * @return Review[]
     */
    private function buildReviews(array $data)
    {
        $reviews = [];

        foreach ($data as $review) {
            $reviews[] = $this->buildReview($review);
        }

        return $reviews;
    }

    /**
     * @param mixed[] $data
     *
     * @return Review
     */
    private function buildReview(array $data)
    {
        $review = new Review();
        $review->setAuthorName($data['author_name']);
        $review->setAuthorUrl($data['author_url']);
        $review->setText($data['text']);
        $review->setRating($data['rating']);
        $review->setTime(new \DateTime('@'.$data['time']));
        $review->setLanguage($data['language']);
        $review->setAspects($this->buildAspectRatings($data['aspects']));

        return $review;
    }

    /**
     * @param mixed[] $data
     *
     * @return AspectRating[]
     */
    private function buildAspectRatings(array $data)
    {
        $aspectRatings = [];

        foreach ($data as $aspectRating) {
            $aspectRatings[] = $this->buildAspectRating($aspectRating);
        }

        return $aspectRatings;
    }

    /**
     * @param mixed[] $data
     *
     * @return AspectRating
     */
    private function buildAspectRating(array $data)
    {
        if (isset($data['types'])) {
            $data['type'] = reset($data['types']);
        }

        $aspectRating = new AspectRating();
        $aspectRating->setType($data['type']);
        $aspectRating->setRating($data['rating']);

        return $aspectRating;
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

        if (isset($data['viewport'])) {
            $geometry->setViewport($this->buildBound($data['viewport']));
        }

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
        $openingHours->setWeekdayTexts($data['weekday_text']);
        $openingHours->setPeriods($this->buildPeriods($data['periods']));

        return $openingHours;
    }

    /**
     * @param mixed[] $data
     *
     * @return Period[]
     */
    private function buildPeriods(array $data)
    {
        $periods = [];

        foreach ($data as $period) {
            $periods[] = $this->buildPeriod($period);
        }

        return $periods;
    }

    /**
     * @param mixed[] $data
     *
     * @return Period
     */
    private function buildPeriod(array $data)
    {
        $period = new Period();
        $period->setOpen($this->buildOpenClosePeriod($data['open']));
        $period->setClose($this->buildOpenClosePeriod($data['close']));

        return $period;
    }

    /**
     * @param mixed[] $data
     *
     * @return OpenClosePeriod
     */
    private function buildOpenClosePeriod(array $data)
    {
        $openClosePeriod = new OpenClosePeriod();
        $openClosePeriod->setDay($data['day']);
        $openClosePeriod->setTime(\DateTime::createFromFormat('!Hi', $data['time']));

        return $openClosePeriod;
    }

    /**
     * @param mixed[] $data
     *
     * @return Bound
     */
    private function buildBound(array $data)
    {
        return new Bound(
            $this->buildCoordinate($data['southwest']),
            $this->buildCoordinate($data['northeast'])
        );
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
