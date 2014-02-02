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

use Ivory\GoogleMap\Places\AutocompleteType;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;

/**
 * Place exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceException extends Exception
{
    /**
     * Gets the "AUTOCOMPLETE COMPONENT RESTRICTION TYPE ALREADY EXISTS" exception.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "AUTOCOMPLETE RESTRICTION TYPE ALREADY EXISTS" exception.
     */
    public static function autocompleteComponentRestrictionAlreadyExists($type)
    {
        return new static(sprintf('The place autocomplete component restriction type "%s" already exists.', $type));
    }

    /**s
     * Gets the "AUTOCOMPLETE COMPONENT RESTRICTION TYPE DOES NOT EXIST" exception.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "AUTOCOMPLETE RESTRICTION TYPE DOES DOES NOT EXIST" exception.
     */
    public static function autocompleteComponentRestrictionDoesNotExist($type)
    {
        return new static(sprintf('The place autocomplete component restriction type "%s" does not exist.', $type));
    }

    /**
     * Gets the "AUTOCOMPLETE TYPE ALREADY EXISTS" exception.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "AUTOCOMPLETE TYPE ALREADY EXISTS" exception.
     */
    public static function autocompleteTypeAlreadyExists($type)
    {
        return new static(sprintf('The place autocomplete type "%s" already exists.', $type));
    }

    /**
     * Gets the "AUTOCOMPLETE TYPE DOES NOT EXIST" exception.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "AUTOCOMPLETE TYPE DOES NOT EXIST" exception.
     */
    public static function autocompleteTypeDoesNotExist($type)
    {
        return new static(sprintf('The place autocomplete type "%s" does not exist.', $type));
    }

    /**
     * Gets the "INVALID AUTOCOMPLETE ASYNC" exception.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "INVALID AUTOCOMPLETE ASYNC" exception.
     */
    public static function invalidAutocompleteAsync()
    {
        return new static('The asynchronous load of a place autocomplete must be a boolean value.');
    }

    /**
     * Gets the "INVALID AUTOCOMPLETE BOUND" exception.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "INVALID AUTOCOMPLETE BOUND" exception.
     */
    public static function invalidAutocompleteBound()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The bound setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setBound(Ivory\GoogleMap\Base\Bound $bound)',
            ' - function setBount('.
            'Ivory\GoogleMap\Base\Coordinate $southWest, '.
            'Ivory\GoogleMap\Base\Coordinate $northEast'.
            ')',
            ' - function setBound('.
            'double $southWestLatitude, '.
            'double $southWestLongitude, '.
            'double $northEastLatitude, '.
            'double $northEastLongitude, '.
            'boolean southWestNoWrap = true, '.
            'boolean $northEastNoWrap = true'.
            ')'
        ));
    }

    /**
     * Gets the "INVALID AUTOCOMPLETE COMPONENT RESTRICTION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "INVALID AUTOCOMPLETE COMPONENT RESTRICTION" exception.
     */
    public static function invalidAutocompleteComponentRestriction()
    {
        return new static(
            sprintf(
                'The place autocomplete component restriction can only be: %s.',
                implode(', ', AutocompleteComponentRestriction::getAvailableAutocompleteComponentRestrictions())
            )
        );
    }

    /**
     * Gets the "INVALID AUTOCOMPLETE INPUT ID" exception.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "INVALID AUTOCOMPLETE INPUT ID" exception.
     */
    public static function invalidAutocompleteInputId()
    {
        return new static('The place autocomplete input ID must be a string value.');
    }

    /**
     * Gets the "INVALID AUTOCOMPLETE TYPE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\PlaceException The "INVALID AUTOCOMPLETE TYPE" exception.
     */
    public static function invalidAutocompleteType()
    {
        return new static(
            sprintf(
                'The place autocomplete type can only be: %s.',
                implode(', ', AutocompleteType::getAvailableAutocompleteTypes())
            )
        );
    }
}
