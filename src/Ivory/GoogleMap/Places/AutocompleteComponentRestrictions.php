<?php


namespace Ivory\GoogleMap\Places;

/**
 * Class AutocompleteComponentRestrictions
 * @package Ivory\GoogleMap\Places
 * @author Semyon Velichko <semyon@velichko.net>
 */
class AutocompleteComponentRestrictions
{

    const COUNTRY = 'country';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {
    }

    /**
     * @return array
     */
    public static function getAvailableAutocompleteComponentRestrictions()
    {
        return array(
            self::COUNTRY
        );
    }

} 