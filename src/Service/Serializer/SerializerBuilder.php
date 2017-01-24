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

use Ivory\Serializer\Mapping\Factory\CacheClassMetadataFactory;
use Ivory\Serializer\Mapping\Factory\ClassMetadataFactory;
use Ivory\Serializer\Mapping\Loader\ChainClassMetadataLoader;
use Ivory\Serializer\Mapping\Loader\XmlClassMetadataLoader;
use Ivory\Serializer\Navigator\Navigator;
use Ivory\Serializer\Registry\TypeRegistry;
use Ivory\Serializer\Serializer;
use Ivory\Serializer\Type\ObjectType;
use Ivory\Serializer\Type\Type;
use Psr\Cache\CacheItemPoolInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SerializerBuilder
{
    /**
     * @param CacheItemPoolInterface|null $pool
     *
     * @return Serializer
     */
    public static function create(CacheItemPoolInterface $pool = null)
    {
        $classMetadataFactory = new ClassMetadataFactory(new ChainClassMetadataLoader([
            new XmlClassMetadataLoader(__DIR__.'/Base/AddressComponent.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Bound.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Coordinate.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Distance.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Duration.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Fare.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Geometry.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Base/Time.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/DirectionGeocoded.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/DirectionLeg.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/DirectionResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/DirectionRoute.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/DirectionStep.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/DirectionWaypoint.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/Transit/DirectionTransitAgency.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/Transit/DirectionTransitDetails.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/Transit/DirectionTransitLine.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/Transit/DirectionTransitStop.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Direction/Transit/DirectionTransitVehicle.xml'),
            new XmlClassMetadataLoader(__DIR__.'/DistanceMatrix/DistanceMatrixElement.xml'),
            new XmlClassMetadataLoader(__DIR__.'/DistanceMatrix/DistanceMatrixResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/DistanceMatrix/DistanceMatrixRow.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Elevation/ElevationResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Elevation/ElevationResult.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Geocoder/GeocoderResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Geocoder/GeocoderResult.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Overlay/EncodedPolyline.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Autocomplete/PlaceAutocompleteMatch.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Autocomplete/PlaceAutocompletePrediction.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Autocomplete/PlaceAutocompleteResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Autocomplete/PlaceAutocompleteTerm.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/AlternatePlaceId.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/AspectRating.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/OpenClosePeriod.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/OpeningHours.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/Period.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/Photo.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/Place.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Base/Review.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Detail/PlaceDetailResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/Place/Search/PlaceSearchResponse.xml'),
            new XmlClassMetadataLoader(__DIR__.'/TimeZone/TimeZoneResponse.xml'),
        ]));

        if ($pool !== null) {
            $classMetadataFactory = new CacheClassMetadataFactory($classMetadataFactory, $pool);
        }

        return new Serializer(new Navigator(TypeRegistry::create([
            Type::OBJECT => new ObjectType($classMetadataFactory),
        ])));
    }
}
