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

use DateTime;
use Ivory\GoogleMap\Service\Place\Base\AlternatePlaceId;
use Ivory\GoogleMap\Service\Place\Base\AspectRating;
use Ivory\GoogleMap\Service\Place\Base\OpenClosePeriod;
use Ivory\GoogleMap\Service\Place\Base\OpeningHours;
use Ivory\GoogleMap\Service\Place\Base\Period;
use Ivory\GoogleMap\Service\Place\Base\Photo;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Base\PlusCode;
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
            $this->assertNull($place);

            return;
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
            'types'                      => [],
            'plus_code'                  => [],
            'permanently_close'          => null,
            'business_status'            => null,
            'user_ratings_total'         => null,
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
        $this->assertSame(isset($options['rating']) ? (float)$options['rating'] : null, $place->getRating());
        $this->assertSame($options['business_status'], $place->getBusinessStatus());
        $this->assertGeometry($place->getGeometry(), $options['geometry']);
        $this->assertOpeningHours($place->getOpeningHours(), $options['opening_hours']);
        $this->assertPlusCode($place->getPlusCode(), $options['plus_code']);

        $this->assertCount(is_countable($options['address_components']) ? count($options['address_components']) : 0, $addressComponents = $place->getAddressComponents());

        foreach ($options['address_components'] as $key => $addressComponent) {
            $this->assertArrayHasKey($key, $addressComponents);
            $this->assertAddressComponent($addressComponents[$key], $addressComponent);
        }

        $this->assertCount(is_countable($options['photos']) ? count($options['photos']) : 0, $photos = $place->getPhotos());

        foreach ($options['photos'] as $key => $photo) {
            $this->assertArrayHasKey($key, $photos);
            $this->assertPhoto($photos[$key], $photo);
        }

        $this->assertCount(
            is_countable($options['alt_ids']) ? count($options['alt_ids']) : 0,
            $alternatePlaceIds = $place->getAlternatePlaceIds()
        );

        foreach ($options['alt_ids'] as $key => $alternatePlaceId) {
            $this->assertArrayHasKey($key, $alternatePlaceIds);
            $this->assertAlternatePlaceId($alternatePlaceIds[$key], $alternatePlaceId);
        }

        $this->assertCount(is_countable($options['reviews']) ? count($options['reviews']) : 0, $reviews = $place->getReviews());

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
        // The opening hours can be missing completely, or be an empty tag

        if (empty($options)) {
            if ($openingHours instanceof OpeningHours) {
                $this->assertNull($openingHours->isOpenNow());
                $this->assertEmpty($openingHours->getPeriods());
                $this->assertEmpty($openingHours->getWeekdayTexts());
            } else {
                $this->assertNull($openingHours);
            }

            return;
        }

        $options = array_merge([
            'open_now'     => null,
            'periods'      => [],
            'weekday_text' => [],
        ], $options);

        $this->assertInstanceOf(OpeningHours::class, $openingHours);

        $this->assertSame($options['open_now'], $openingHours->isOpenNow());
        $this->assertSame($options['weekday_text'], $openingHours->getWeekdayTexts());

        $this->assertCount(is_countable($options['periods']) ? count($options['periods']) : 0, $periods = $openingHours->getPeriods());

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
            $this->assertNull($photo);

            return;
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
            $this->assertNull($alternatePlaceId);

            return;
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
            $this->assertNull($review);

            return;
        }

        $options = array_merge([
            'author_name' => null,
            'author_url'  => null,
            'text'        => null,
            'rating'      => null,
            'time'        => null,
            'language'    => null,
            'aspects'     => [],
        ], $options);

        $this->assertInstanceOf(Review::class, $review);

        $this->assertSame($options['author_name'], $review->getAuthorName());
        $this->assertSame($options['author_url'], $review->getAuthorUrl());
        $this->assertSame($options['text'], $review->getText());
        $this->assertSame((float)$options['rating'], $review->getRating());
        $this->assertSame((new DateTime('@' . $options['time']))->getTimestamp(), $review->getTime()->getTimestamp());
        $this->assertSame($options['language'], $review->getLanguage());

        $this->assertCount(is_countable($options['aspects']) ? count($options['aspects']) : 0, $aspects = $review->getAspects());

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
            $this->assertNull($period);

            return;
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
            $this->assertNull($openClosePeriod);

            return;
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
            $this->assertNull($aspectRating);

            return;
        }

        $options = array_merge([
            'type'   => null,
            'rating' => null,
        ], $options);

        $this->assertInstanceOf(AspectRating::class, $aspectRating);

        $this->assertSame($options['type'], $aspectRating->getType());
        $this->assertSame((float)$options['rating'], $aspectRating->getRating());
    }

    /**
     * @param PlusCode $plusCode
     * @param mixed[]  $options
     */
    protected function assertPlusCode($plusCode, array $options = [])
    {
        if (empty($options)) {
            $this->assertNull($plusCode);

            return;
        }

        $options = array_merge([
            'global_code'   => null,
            'compound_code' => null,
        ], $options);

        $this->assertInstanceOf(PlusCode::class, $plusCode);

        $this->assertSame($options['global_code'], $plusCode->getGlobalCode());
        $this->assertSame($options['compound_code'], $plusCode->getCompoundCode());
    }
}
