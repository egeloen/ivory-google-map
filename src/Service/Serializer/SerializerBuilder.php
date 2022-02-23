<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Serializer;

use Ivory\GoogleMap\Serializer\Normalizer\AddressComponentNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\GeocodedWaypointNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\LegNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\DirectionResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\DirectionResponseWaypointNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit\AgencyNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit\DetailsNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit\LineNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit\StopNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\Response\Transit\VehicleNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\RouteNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Direction\StepNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\DistanceMatrix\Response\DistanceMatrixResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\DistanceMatrix\Response\ElementNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\DistanceMatrix\Response\RowNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\DistanceNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\DurationNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Elevation\Response\ElevationResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Elevation\Response\ResultNormalizer as ElevationResponseResultNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Geocoder\Response\GeocoderResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Geocoder\Response\ResultNormalizer as GeocoderResponseResultNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Map\BoundNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Map\CoordinateNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Map\GeometryNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Overlay\EncodedPolylineNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\PhotoNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\AlternatePlaceIdNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete\PlaceAutocompleteMatchNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete\PlaceAutocompletePredictionNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete\PlaceAutocompleteResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\Autocomplete\PlaceAutocompleteTermNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\OpenClosePeriodNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\OpeningHoursNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\PeriodNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\PlaceNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\PlusCodeNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\Response\PlaceDetailResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\Response\PlaceSearchResponseNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Place\ReviewNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\TimeNormalizer;
use Ivory\GoogleMap\Serializer\Normalizer\Timezone\Response\TimezoneResponseNormalizer;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SerializerBuilder
{
    /**
     * @param CacheItemPoolInterface|null $pool
     */
    public static function create(CacheItemPoolInterface $pool = null): Serializer
    {
//        $classMetadataFactory = new ClassMetadataFactory(new XmlFileLoader(
//            __DIR__ . DIRECTORY_SEPARATOR .
//            '..' . DIRECTORY_SEPARATOR .
//            '..' . DIRECTORY_SEPARATOR .
//            '..' . DIRECTORY_SEPARATOR .
//            'data' . DIRECTORY_SEPARATOR .
//            'mapping.xml'
//        ));
//
//        if ($pool !== null) {
//            $classMetadataFactory = new CacheClassMetadataFactory($classMetadataFactory, $pool);
//        }
//
//        $objectNormalizer = new ObjectNormalizer($classMetadataFactory, new CamelCaseToSnakeCaseNameConverter());
//        $arrayNormalizer = new ArrayDenormalizer();
//        $getSetMethodNormalizer = new GetSetMethodNormalizer($classMetadataFactory);

        static $serializer;

        if (is_null($serializer)) {
            $normalizers = [
                // Generic
                new DistanceNormalizer(),
                new DurationNormalizer(),
                new TimeNormalizer(),

                // Distance Matrix
                new DistanceMatrixResponseNormalizer(),
                new RowNormalizer(),
                new ElementNormalizer(),

                // Elevation
                new ElevationResponseNormalizer(),
                new ElevationResponseResultNormalizer(),

                // Geocoder
                new GeocoderResponseNormalizer(),
                new GeocoderResponseResultNormalizer(),

                // Overlay
                new EncodedPolylineNormalizer(),

                // Timezone
                new TimezoneResponseNormalizer(),

                // Directions
                new DirectionResponseNormalizer(),
                new DirectionResponseWaypointNormalizer(),
                new DetailsNormalizer(),
                new StopNormalizer(),
                new LineNormalizer(),
                new AgencyNormalizer(),
                new VehicleNormalizer(),
                new GeocodedWaypointNormalizer(),
                new RouteNormalizer(),
                new LegNormalizer(),
                new StepNormalizer(),

                new PlaceAutocompleteResponseNormalizer(),
                new PlaceSearchResponseNormalizer(),
                new PlaceDetailResponseNormalizer(),

                new PlaceAutocompletePredictionNormalizer(),
                new PlaceAutocompleteTermNormalizer(),
                new PlaceAutocompleteMatchNormalizer(),
                new PlaceNormalizer(),

                new GeometryNormalizer(),
                new CoordinateNormalizer(),
                new BoundNormalizer(),
                new OpeningHoursNormalizer(),
                new PeriodNormalizer(),
                new OpenClosePeriodNormalizer(),
                new PlusCodeNormalizer(),
                new AddressComponentNormalizer(),
                new PhotoNormalizer(),
                new AlternatePlaceIdNormalizer(),
                new ReviewNormalizer(),
            ];

            $jsonEncoder = new JsonEncoder();
            $serializer  = new Serializer($normalizers, [$jsonEncoder]);
        }

        return $serializer;
    }
}
