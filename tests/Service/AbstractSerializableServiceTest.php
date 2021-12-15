<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service;

use DateTime;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\AbstractSerializableService;
use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Fare;
use Ivory\GoogleMap\Service\Base\Geometry;
use Ivory\GoogleMap\Service\Base\Time;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractSerializableServiceTest extends AbstractFunctionalServiceTest
{
    /**
     * @return string[][]
     */
    public function formatProvider()
    {
        return [
            'json' => [AbstractSerializableService::FORMAT_JSON],
            'xml'  => [AbstractSerializableService::FORMAT_XML],
        ];
    }

    /**
     * @param AddressComponent $addressComponent
     * @param mixed[]          $options
     */
    protected function assertAddressComponent($addressComponent, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($addressComponent);
        }

        $options = array_merge([
            'long_name'  => null,
            'short_name' => null,
            'types'      => [],
        ], $options);

        $this->assertInstanceOf(AddressComponent::class, $addressComponent);

        $this->assertSame($options['long_name'], $addressComponent->getLongName());
        $this->assertSame($options['short_name'], $addressComponent->getShortName());
        $this->assertSame($options['types'], $addressComponent->getTypes());
    }

    /**
     * @param Bound   $bound
     * @param mixed[] $options
     */
    protected function assertBound($bound, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($bound);
        }

        $options = array_merge([
            'southwest' => null,
            'northeast' => null,
        ], $options);

        $this->assertInstanceOf(Bound::class, $bound);

        $this->assertCoordinate($bound->getSouthWest(), $options['southwest']);
        $this->assertCoordinate($bound->getNorthEast(), $options['northeast']);
    }

    /**
     * @param Coordinate $coordinate
     * @param mixed[]    $options
     */
    protected function assertCoordinate($coordinate, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($coordinate);
        }

        $options = array_merge([
            'lat' => null,
            'lng' => null,
        ], $options);

        $this->assertInstanceOf(Coordinate::class, $coordinate);

        $this->assertEqualsWithDelta($options['lat'], $coordinate->getLatitude(), 5);
        $this->assertEqualsWithDelta($options['lng'], $coordinate->getLongitude(), 5);
    }

    /**
     * @param mixed[]  $options
     */
    protected function assertDistance(Distance $distance, array $options = [])
    {
        if (empty($options)) {
            $this->assertNull($distance);

            return;
        }

        $options = array_merge([
            'value' => null,
            'text'  => null,
        ], $options);

        $this->assertInstanceOf(Distance::class, $distance);

        $this->assertEquals($options['value'], $distance->getValue());
        $this->assertSame($options['text'], $distance->getText());
    }

    /**
     * @param Duration $duration
     * @param mixed[]  $options
     */
    protected function assertDuration($duration, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($duration);
        }

        $options = array_merge([
            'value' => null,
            'text'  => null,
        ], $options);

        $this->assertInstanceOf(Duration::class, $duration);

        $this->assertGreaterThan($options['value'] - 50, $duration->getValue());
        $this->assertLessThan($options['value'] + 50, $duration->getValue());
        $this->assertSame($options['text'], $duration->getText());
    }

    /**
     * @param Fare    $fare
     * @param mixed[] $options
     */
    protected function assertFare($fare, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($fare);
        }

        $options = array_merge([
            'value'    => null,
            'currency' => null,
            'text'     => null,
        ], $options);

        $this->assertInstanceOf(Fare::class, $fare);

        $this->assertSame($options['value'], $fare->getValue());
        $this->assertSame($options['currency'], $fare->getCurrency());
        $this->assertSame($options['text'], $fare->getText());
    }

    /**
     * @param Geometry $geometry
     * @param mixed[]  $options
     */
    protected function assertGeometry($geometry, array $options = [])
    {
        $options = array_merge([
            'location'      => [],
            'location_type' => null,
            'viewport'      => [],
            'bounds'        => [],
        ], $options);

        $this->assertInstanceOf(Geometry::class, $geometry);

        $this->assertSame($options['location_type'], $geometry->getLocationType());
        $this->assertCoordinate($geometry->getLocation(), $options['location']);
        $this->assertBound($geometry->getViewport(), $options['viewport']);
        $this->assertBound($geometry->getBound(), $options['bounds']);
    }

    /**
     * @param Time    $time
     * @param mixed[] $options
     */
    protected function assertTime($time, array $options = [])
    {
        if (empty($options)) {
            return $this->assertNull($time);
        }

        $options = array_merge([
            'value'     => null,
            'time_zone' => null,
            'text'      => null,
        ], $options);

        $this->assertInstanceOf(Time::class, $time);

        $this->assertSame($time->getValue()->getTimestamp(), (new DateTime('@' . $options['value']))->getTimestamp());
        $this->assertSame($time->getTimeZone(), $options['time_zone']);
        $this->assertSame($time->getText(), $options['text']);
    }
}
