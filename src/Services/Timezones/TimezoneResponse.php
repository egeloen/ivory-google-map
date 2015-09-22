<?php
/**
 * TimezoneResponse.php Class
 *
 * Date: 2015-09-22
 * Time: 4:49 PM
 */

namespace Ivory\GoogleMap\Services\Timezones;

/**
 * Class TimezoneResponse
 * @package Ivory\GoogleMap\Services\Timezones
 */
class TimezoneResponse
{
    /** @var int */
    protected $dstOffset;

    /** @var int */
    protected $rawOffset;

    /** @var string */
    protected $status;

    /** @var string */
    protected $timeZoneId;

    /** @var string */
    protected $timeZoneName;

    /** @var array */
    protected $attributes;

    /**
     * @param array $attributes
     */
    public function __construct( array $attributes )
    {
        if ( ! count( $attributes ) ) {
            throw new \InvalidArgumentException( 'TimezoneResponse received empty attributes.' );
        }
        $this->populate( $attributes );
    }

    /**
     * Take in an array of key value pairs and populate the properties of the class
     *
     * @param array $attributes
     */
    protected function populate( array $attributes )
    {
        // Iterate over the array and populate the attribute
        foreach ( $attributes as $key => $value ) {
            if ( property_exists( $this, $key ) ) {
                $this->$key = $value;
                $this->attributes[$key] = $value;
            }
        }
    }

    /**
     * Attempt to retrieve the value of a property via object->property
     *
     * @param $key
     * @return null
     */
    public function __get( $key )
    {
        if ( array_key_exists( $key, $this->attributes ) ) {
            return $this->attributes[$key];
        }
        else {
            return null;
        }
    }

    /**
     * Attempt to set the value of a property via object->property = 'foo'
     *
     * @param $key
     * @param $value
     * @throws \InvalidArgumentException
     */
    public function __set( $key, $value )
    {
        if ( property_exists( $this, $key) ) {
            $this->$key = $value;
        }
        else {
            throw new \InvalidArgumentException( 'Unsupported property: ' . $key );
        }
    }

    /**
     * Attempt to unset a property
     *
     * @param $key
     */
    public function __unset( $key )
    {
        if ( property_exists( $this, $key ) ) {
            unset( $this->$key );
        }
    }

    /**
     * Get the attributes array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

}
