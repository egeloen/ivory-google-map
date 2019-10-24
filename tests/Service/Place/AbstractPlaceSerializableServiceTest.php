<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place;

use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\AspectRating;
use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Base\Review;
use Ivory\Tests\GoogleMap\Service\AbstractSerializableServiceTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPlaceSerializableServiceTest extends AbstractSerializableServiceTest
{
    /**
     * @param Place   $place
     * @param mixed[] $options
     */
    protected function assertPlace($place, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($place);
        }

        $options = array_merge([
            'id'                         => null,
            'place_id'                   => null,
            'name'                       => null,
            'formatted_address'          => null,
            'formatted_phone_number'     => null,
            'international_phone_number' => null,
            'url'                        => null,
            'icon'                       => null,
            'scope'                      => null,
            'price_level'                => null,
            'rating'                     => null,
            'utc_offset'                 => null,
            'vicinity'                   => null,
            'website'                    => null,
            'geometry'                   => [],
            'opening_hours'              => [],
            'address_components'         => [],
            'photos'                     => [],
            'alt_ids'                    => [],
            'reviews'                    => [],
            'user_ratings_total'         => null,
            'types'                      => [],
            'permanently_close'          => null,
        ], $options);

        $this->assertInstanceOf(Place::class, $place);

        $this->assertSame($options['id'], $place->getId());
        $this->assertSame($options['place_id'], $place->getPlaceId());
        $this->assertSame($options['name'], $place->getName());
        $this->assertSame($options['formatted_address'], $place->getFormattedAddress());
        $this->assertSame($options['formatted_phone_number'], $place->getFormattedPhoneNumber());
        $this->assertSame($options['international_phone_number'], $place->getInternationalPhoneNumber());
        $this->assertSame($options['url'], $place->getUrl());
        $this->assertSame($options['icon'], $place->getIcon());
        $this->assertSame($options['scope'], $place->getScope());
        $this->assertSame($options['price_level'], $place->getPriceLevel());
        $this->assertSame($options['utc_offset'], $place->getUtcOffset());
        $this->assertSame($options['vicinity'], $place->getVicinity());
        $this->assertSame($options['website'], $place->getWebsite());
        $this->assertSame($options['types'], $place->getTypes());
        $this->assertSame($options['permanently_close'], $place->isPermanentlyClose());
        $this->assertSame(isset($options['rating']) ? (float) $options['rating'] : null, $place->getRating());
        $this->assertSame(isset($options['user_ratings_total']) ? (int) $options['user_ratings_total'] : null, $place->getUserRatingsTotal());

        $this->assertGeometry($place->getGeometry(), $options['geometry']);
        $this->assertOpeningHours($place->getOpeningHours(), $options['opening_hours']);

        $this->assertCount(count($options['address_components']), $addressComponents = $place->getAddressComponents());

        foreach ($options['address_components'] as $key => $addressComponent) {
            $this->assertArrayHasKey($key, $addressComponents);
            $this->assertAddressComponent($addressComponents[$key], $addressComponent);
        }

        $this->assertCount(count($options['photos']), $photos = $place->getPhotos());

        foreach ($options['photos'] as $key => $photo) {
            $this->assertArrayHasKey($key, $photos);
            $this->assertPhoto($photos[$key], $photo);
        }

        $this->assertCount(
            count($options['alt_ids']),
            $alternatePlaceIds = $place->getAlternatePlaceIds()
        );

        foreach ($options['alt_ids'] as $key => $alternatePlaceId) {
            $this->assertArrayHasKey($key, $alternatePlaceIds);
            $this->assertAlternatePlaceId($alternatePlaceIds[$key], $alternatePlaceId);
        }

        $this->assertCount(count($options['reviews']), $reviews = $place->getReviews());

        foreach ($options['reviews'] as $key => $review) {
            $this->assertArrayHasKey($key, $reviews);
            $this->assertReview($reviews[$key], $review);
        }
    }

    /**
     * @param OpeningHours $openingHours
     * @param mixed[]      $options
     */
    protected function assertOpeningHours($openingHours, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($openingHours);
        }

        $options = array_merge([
            'open_now'     => null,
            'periods'      => [],
            'weekday_text' => [],
        ], $options);

        $this->assertInstanceOf(OpeningHours::class, $openingHours);

        $this->assertSame($options['open_now'], $openingHours->isOpenNow());
        $this->assertSame($options['weekday_text'], $openingHours->getWeekdayTexts());

        $this->assertCount(count($options['periods']), $periods = $openingHours->getPeriods());

        foreach ($options['periods'] as $key => $period) {
            $this->assertArrayHasKey($key, $periods);
            $this->assertPeriod($periods[$key], $period);
        }
    }

    /**
     * @param Photo   $photo
     * @param mixed[] $options
     */
    protected function assertPhoto($photo, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($photo);
        }

        $options = array_merge([
            'width'             => null,
            'height'            => null,
            'html_attributions' => [],
        ], $options);

        $this->assertInstanceOf(Photo::class, $photo);

        $this->assertNotEmpty($photo->getReference());
        $this->assertSame($options['width'], $photo->getWidth());
        $this->assertSame($options['height'], $photo->getHeight());
        $this->assertSame($options['html_attributions'], $photo->getHtmlAttributions());
    }

    /**
     * @param AlternatePlaceId $alternatePlaceId
     * @param mixed[]          $options
     */
    protected function assertAlternatePlaceId($alternatePlaceId, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($alternatePlaceId);
        }

        $options = array_merge([
            'place_id' => null,
            'scope'    => null,
        ], $options);

        $this->assertInstanceOf(AlternatePlaceId::class, $alternatePlaceId);

        $this->assertSame($options['place_id'], $alternatePlaceId->getPlaceId());
        $this->assertSame($options['scope'], $alternatePlaceId->getScope());
    }

    /**
     * @param Review  $review
     * @param mixed[] $options
     */
    protected function assertReview($review, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($review);
        }

        $options = array_merge([
            'author_name'               => null,
            'author_url'                => null,
            'profile_photo_url'         => null,
            'text'                      => null,
            'rating'                    => null,
            'time'                      => null,
            'relative_time_description' => null,
            'language'                  => null,
            'aspects'                   => [],
        ], $options);

        $this->assertInstanceOf(Review::class, $review);

        $this->assertSame($options['author_name'], $review->getAuthorName());
        $this->assertSame($options['author_url'], $review->getAuthorUrl());
        $this->assertSame($options['profile_photo_url'], $review->getProfilePhotoUrl());
        $this->assertSame($options['text'], $review->getText());
        $this->assertSame((float) $options['rating'], $review->getRating());
        $this->assertSame((new \DateTime('@'.$options['time']))->getTimestamp(), $review->getTime()->getTimestamp());
        $this->assertSame($options['relative_time_description'], $review->getRelativeTimeDescription());
        $this->assertSame($options['language'], $review->getLanguage());

        $this->assertCount(count($options['aspects']), $aspects = $review->getAspects());

        foreach ($options['aspects'] as $key => $aspect) {
            $this->assertArrayHasKey($key, $aspects);
            $this->assertAspectRating($aspects[$key], $aspect);
        }
    }

    /**
     * @param Period  $period
     * @param mixed[] $options
     */
    protected function assertPeriod($period, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($period);
        }

        $options = array_merge([
            'open'  => [],
            'close' => [],
        ], $options);

        $this->assertInstanceOf(Period::class, $period);

        $this->assertOpenClosePeriod($period->getOpen(), $options['open']);
        $this->assertOpenClosePeriod($period->getClose(), $options['close']);
    }

    /**
     * @param OpenClosePeriod $openClosePeriod
     * @param mixed[]         $options
     */
    protected function assertOpenClosePeriod($openClosePeriod, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($openClosePeriod);
        }

        $options = array_merge([
            'day'  => null,
            'time' => null,
        ], $options);

        $this->assertInstanceOf(OpenClosePeriod::class, $openClosePeriod);

        $this->assertSame($options['day'], $openClosePeriod->getDay());
        $this->assertSame($options['time'], $openClosePeriod->getTime());
    }

    /**
     * @param AspectRating $aspectRating
     * @param mixed[]      $options
     */
    protected function assertAspectRating($aspectRating, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($aspectRating);
        }

        $options = array_merge([
            'type'   => null,
            'rating' => null,
        ], $options);

        $this->assertInstanceOf(AspectRating::class, $aspectRating);

        $this->assertSame($options['type'], $aspectRating->getType());
        $this->assertSame((float) $options['rating'], $aspectRating->getRating());
    }
}
