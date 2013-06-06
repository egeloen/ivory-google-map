<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Exception;

use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;
use Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * DistanceMatrix exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixException extends ServiceException
{
    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST" exception.
     */
    public static function invalidDistanceMatrixRequest()
    {
        return new static('The directions request is not valid. It needs at least one origin and one destination.');
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST PARAMETERS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST PARAMETERS" exception.
     */
    public static function invalidDistanceMatrixRequestParameters()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The process arguments are invalid.',
            'The available prototypes are:',
            '- function process(array $origins, array $destinations)',
            '- function process(Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $request)'
        ));
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST DESTINATION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST DESTINATION" exception.
     */
    public static function invalidDistanceMatrixRequestDestination()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The destination adder arguments are invalid.',
            'The available prototypes are :',
            ' - function addDestination(string $destination)',
            ' - function addDestination(Ivory\GoogleMap\Base\Coordinate $destination)',
            ' - function addDestination(double $latitude, double $longitude, boolean $noWrap)'
        ));
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST ORIGIN" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST ORIGIN" exception.
     */
    public static function invalidDistanceMatrixRequestOrigin()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The origin adder arguments are invalid.',
            'The available prototypes are :',
            ' - function addOrigin(string $origin)',
            ' - function addOrigin(Ivory\GoogleMap\Base\Coordinate $origin)',
            ' - function addOrigin(double $latitude, double $longitude, boolean $noWrap)'
        ));
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST REGION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST REGION" exception.
     */
    public static function invalidDistanceMatrixRequestRegion()
    {
        return new static('The distance matrix request region must be a string with two characters.');
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST LANGUAGE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST LANGUAGE" exception.
     */
    public static function invalidDistanceMatrixRequestLanguage()
    {
        return new static('The distance matrix request language must be a string with two characters.');
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST SENSOR" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST SENSOR" exception.
     */
    public static function invalidDistanceMatrixRequestSensor()
    {
        return new static('The distance matrix request sensor flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST TRAVEL MODE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST TRAVEL MODE" exception.
     */
    public static function invalidDistanceMatrixRequestTravelMode()
    {
        $travelModes = array_diff(TravelMode::getTravelModes(), array(TravelMode::TRANSIT));

        return new static(sprintf(
            'The distance matrix request travel mode can only be : %s.',
            implode(', ', $travelModes)
        ));
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST UNIT SYSTEM" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST UNIT SYSTEM" exception.
     */
    public static function invalidDistanceMatrixRequestUnitSystem()
    {
        return new static(sprintf(
            'The distance matrix request unit system can only be : %s.',
            implode(', ', UnitSystem::getUnitSystems())
        ));
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST AVOID HIGHWAYS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST AVOID HIGHWAYS" exception.
     */
    public static function invalidDistanceMatrixRequestAvoidHighways()
    {
        return new static('The distance matrix request avoid hightways flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX REQUEST AVOID TOLLS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX REQUEST AVOID TOLLS" exception.
     */
    public static function invalidDistanceMatrixRequestAvoidTolls()
    {
        return new static('The distance matrix request avoid tolls flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX RESPONSE STATUS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX RESPONSE STATUS" exception.
     */
    public static function invalidDistanceMatrixResponseStatus()
    {
        return new static(sprintf(
            'The distance matrix response status can only be : %s.',
            implode(', ', DistanceMatrixStatus::getDistanceMatrixStatus())
        ));
    }

    /**
     * Gets the "INVALID DISTANCE MATRIX RESPONSE ELEMENT STATUS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DistanceMatrixException The "INVALID DISTANCE MATRIX RESPONSE ELEMENT STATUS" exception.
     */
    public static function invalidDistanceMatrixResponseElementStatus()
    {
        return new static(sprintf(
            'The distance matrix response element status can only be : %s.',
            implode(', ', DistanceMatrixElementStatus::getDistanceMatrixElementStatus())
        ));
    }
}
