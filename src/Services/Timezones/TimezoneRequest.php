<?php
/**
 * TimezoneRequest.php Class
 *
 * Date: 2015-09-22
 * Time: 3:34 PM
 */

namespace Ivory\GoogleMap\Services\Timezones;

/**
 * Class TimezoneRequest
 * @package Ivory\GoogleMap\Services\Timezones
 */
class TimezoneRequest
{
    /**
     * Required, an array containing the 'lat' (latitude) and 'lng' (longitude) keys for a geographic location. Example:
     * array( 'lat' => 45.340488, 'lng' => -75.912674 )
     *
     * @var array
     */
    protected $location;

    /**
     * Optional, the desired time as seconds since midnight, January 1, 1970 UTC. The Google Maps Time Zone API uses the
     * timestamp to determine whether or not Daylight Savings should be applied. Times before 1970 can be expressed as
     * negative values. Example: 1443040678, default is time().
     *
     * @var int */
    protected $timestamp;

    /**
     * Optional, your application's API key. This key identifies your application for purposes of quota management.
     * Google Maps API for Work users must NOT provide this value. Example: see
     * @link https://developers.google.com/console/help/#UsingKeys
     *
     * @var string
     */
    protected $key;

    /**
     * Optional, the language in which to return results. See the list of supported domain languages
     * @link https://developers.google.com/maps/faq#languagesupport. Example: 'en', default is 'en' (English).
     *
     * @var string
     */
    protected $language;

    /**
     * @param array $location
     * @param $timestamp
     * @param $key
     * @param string $language
     */
    public function __construct( array $location, $timestamp = null, $key = null, $language = 'en' )
    {
        $this->setLocation( $location );
        $this->setTimestamp( $timestamp );
        $this->setKey( $key );
        $this->setLanguage( $language );
    }

    /**
     * Set the location for which we want timezone info for
     *
     * @param array $location
     */
    public function setLocation( array $location )
    {
        // Validate the array contains the 'lat' and 'lng' values and that they are numeric
        if ( ! array_key_exists( 'lat', $location ) || ! array_key_exists( 'lng', $location ) ) {
            throw new \InvalidArgumentException( 'Location must include the lat and lng keys.' );
        }
        if ( ! is_numeric( $location['lat'] ) || ! is_numeric( $location['lng'] ) ) {
            throw new \InvalidArgumentException( 'Location must contain numeric lat and lng values.' );
        }

        $this->location = $location;
    }

    /**
     * Get the location for which we want timezone info for
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the sample timestamp
     *
     * @param $timestamp
     */
    public function setTimestamp( $timestamp )
    {
        // If a specific timestamp was provided, validate its an integer
        if ( $timestamp ) {
            if ( ! is_int( $timestamp  ) ) {
                throw new \InvalidArgumentException( 'Timestamp must be a integer.' );
            }
            $this->timestamp = $timestamp;
        }
        else {
            $this->timestamp = time();
        }
    }

    /**
     * Get the sample timestamp
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the API key
     *
     * @param $key
     */
    public function setKey( $key )
    {
        // If a key was provided, ensure its a string
        if ( $key ) {
            if ( ! is_string( $key ) ) {
                throw new \InvalidArgumentException( 'Key must be a string.' );
            }

            $this->key = $key;
        }
    }

    /**
     * Get the API key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the desired language of the response
     *
     * @param $language
     */
    public function setLanguage( $language )
    {
        // Ensure we received a 2 char value
        if ( ! $language || strlen( $language ) !== 2 ) {
            throw new \InvalidArgumentException( 'Language is not valid.' );
        }

        $this->language = $language;
    }

    /**
     * Get the desired language of the response
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get an associative array of the object's properties and values
     *
     * @return array
     */
    public function toArray()
    {
        $data = array(
            'location'  => implode( ',',  $this->getLocation() ),
            'timestamp' => $this->getTimestamp(),
            'language'  => $this->getLanguage(),
        );

        // Check for optional API key
        if ( $this->getKey() ) {
            $data['key'] = $this->getKey();
        }

        return $data;
    }

}
