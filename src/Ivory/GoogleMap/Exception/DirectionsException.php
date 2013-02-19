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

use Ivory\GoogleMap\Services\Directions\DirectionsStatus,
    Ivory\GoogleMap\Services\Directions\TravelMode,
    Ivory\GoogleMap\Services\Directions\UnitSystem;

/**
 * Directions exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsException extends ServiceException
{
    /**
     * Gets the "INVALID DIRECTIONS LEG END ADDRESS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS LEG END ADDRESS" exception.
     */
    static public function invalidDirectionsLegEndAddress()
    {
        return new static('The leg end address must be a string value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS LEG START ADDRESS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS LEG START ADDRESS" exception.
     */
    static public function invalidDirectionsLegStartAddress()
    {
        return new static('The leg start address must be a string value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST" exception.
     */
    static public function invalidDirectionsRequest()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s',
            'The directions request is not valid. It needs at least an origin and a destination.',
            'If you add waypoint to the directions request, it needs at least a location.'
        ));
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST PARAMETERS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST PARAMETERS" exception.
     */
    static public function invalidDirectionsRequestParameters()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The route arguments are invalid.',
            'The available prototypes are:',
            '- function route(string $origin, string $destination)',
            '- function route(Ivory\GoogleMap\Services\Directions\DirectionsRequest $request)'
        ));
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST AVOID HIGHWAYS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST AVOID HIGHWAYS" exception.
     */
    static public function invalidDirectionsRequestAvoidHighways()
    {
        return new static('The directions request avoid hightways flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST AVOID TOLLS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST AVOID TOLLS" exception.
     */
    static public function invalidDirectionsRequestAvoidTolls()
    {
        return new static('The directions request avoid tolls flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST DESTINATION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST DESTINATION" exception.
     */
    static public function invalidDirectionsRequestDestination()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The destination setter arguments are invalid.',
            'The available prototypes are :',
            ' - function setDestination(string $destination)',
            ' - function setDestination(Ivory\GoogleMap\Base\Coordinate $destination)',
            ' - function setDestination(double $latitude, double $longitude, boolean $noWrap)'
        ));
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST OPTIMIZE WAYPOINTS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST OPTIMIZE WAYPOINTS" exception.
     */
    static public function invalidDirectionsRequestOptimizeWaypoints()
    {
        return new static('The directions request optimize waypoints flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST ORIGIN" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST ORIGIN" exception.
     */
    static public function invalidDirectionsRequestOrigin()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The origin setter arguments are invalid.',
            'The available prototypes are :',
            ' - function setOrigin(string $destination)',
            ' - function setOrigin(Ivory\GoogleMap\Base\Coordinate $destination)',
            ' - function setOrigin(double $latitude, double $longitude, boolean $noWrap)'
        ));
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST PROVIDE ROUTE ALTERNATIVES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST PROVIDE ROUTE ALTERNATIVES" exception.
     */
    static public function invalidDirectionsRequestProvideRouteAlternatives()
    {
        return new static('The directions request provide route alternatives flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST REGION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST REGION" exception.
     */
    static public function invalidDirectionsRequestRegion()
    {
        return new static('The directions request region must be a string with two characters.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST LANGUAGE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST LANGUAGE" exception.
     */
    static public function invalidDirectionsRequestLanguage()
    {
        return new static('The directions request language must be a string with two characters.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST SENSOR" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST SENSOR" exception.
     */
    static public function invalidDirectionsRequestSensor()
    {
        return new static('The directions request sensor flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST TRAVEL MODE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST TRAVEL MODE" exception.
     */
    static public function invalidDirectionsRequestTravelMode()
    {
        return new static(sprintf('The directions request travel mode can only be : %s.', implode(', ', TravelMode::getTravelModes())));
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST UNIT SYSTEM" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST UNIT SYSTEM" exception.
     */
    static public function invalidDirectionsRequestUnitSystem()
    {
        return new static(sprintf('The directions request unit system can only be : %s.', implode(', ', UnitSystem::getUnitSystems())));
    }

    /**
     * Gets the "INVALID DIRECTIONS REQUEST WAYPOINT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS REQUEST WAYPOINT" exception.
     */
    static public function invalidDirectionsRequestWaypoint()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The waypoint adder arguments are invalid.',
            'The available prototypes are :',
            ' - function addWaypoint(Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint)',
            ' - function addWaypoint(string $location)',
            ' - function addWaypoint(Ivory\GoogleMap\Base\Coordinate $location)',
            ' - function addWaypoint(double $latitude, double $longitude, boolean $noWrap)'
        ));
    }

    /**
     * Gets the "INVALID DIRECTIONS RESPONSE STATUS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS RESPONSE STATUS" exception.
     */
    static public function invalidDirectionsResponseStatus()
    {
        return new static(sprintf('The directions response status can only be : %s.', implode(', ', DirectionsStatus::getDirectionsStatus())));
    }

    /**
     * Gets the "INVALID DIRECTIONS ROUTE COPYRIGHTS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS ROUTE COPYRIGHTS" exception.
     */
    static  public function invalidDirectionsRouteCopyrights()
    {
        return new static('The directions route copyrights must be a string value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS ROUTE SUMMARY" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS ROUTE SUMMARY" exception.
     */
    static public function invalidDirectionsRouteSummary()
    {
        return new static('The directions route summary must be a string value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS ROUTE WARNING" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS ROUTE WARNING" exception.
     */
    static public function invalidDirectionsRouteWarning()
    {
        return new static('The directions route warning must be a string value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS ROUTE WAYPOINT ORDER" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS ROUTE WAYPOINT ORDER" exception.
     */
    static public function invalidDirectionsRouteWaypointOrder()
    {
        return new static('The directions route waypoint order must be an integer value.');
    }

    /**
     * Gets the "INALID DIRECTIONS STEP INSTRUCTIONS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INALID DIRECTIONS STEP INSTRUCTIONS" exception.
     */
    static public function invalidDirectionsStepInstructions()
    {
        return new static('The step instructions must be a string value.');
    }

    /**
     * Gets the "INVALID DIRECTIONS STEP TRAVEL MODE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS STEP TRAVEL MODE" exception.
     */
    static public function invalidDirectionsStepTravelMode()
    {
        return new static(sprintf('The directions step travel mode can only be : %s.', implode(', ', TravelMode::getTravelModes())));
    }

    /**
     * Gets the "INVALID DIRECTIONS WAYPOINT LOCATION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS WAYPOINT LOCATION" exception.
     */
    static public function invalidDirectionsWaypointLocation()
    {
        return new static(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The location setter arguments are invalid.',
            'The available prototypes are :',
            ' - function setLocation(string $destination)',
            ' - function setLocation(Ivory\GoogleMap\Base\Coordinate $destination)',
            ' - function setLocation(double $latitude, double $longitude, boolean $noWrap)'
        ));
    }

    /**
     * Gets the "INVALID DIRECTIONS WAYPOINT STOPOPVER" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DIRECTIONS WAYPOINT STOPOPVER" exception.
     */
    static public function invalidDirectionsWaypointStopover()
    {
        return new static('The directions waypoint stopover flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID DISTANCE TEXT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DISTANCE TEXT" exception.
     */
    static public function invalidDistanceText()
    {
        return new static('The distance text must be a string value.');
    }

    /**
     * Gets the "INVALID DISTANCE VALUE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DISTANCE VALUE" exception.
     */
    static public function invalidDistanceValue()
    {
        return new static('The distance value must be a numeric value.');
    }

    /**
     * Gets the "INVALID DURATION TEXT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DURATION TEXT" exception.
     */
    static public function invalidDurationText()
    {
        return new static('The duration text must be a string value.');
    }

    /**
     * Gets the "INVALID DURATION VALUE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\DirectionsException The "INVALID DURATION VALUE" exception.
     */
    static public function invalidDurationValue()
    {
        return new static('The duration value must be a numeric value.');
    }
}
