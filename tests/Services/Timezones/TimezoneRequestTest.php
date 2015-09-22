<?php
/**
 * TimezoneRequestTest.php Class
 *
 * Date: 2015-09-25
 * Time: 3:38 PM
 */

namespace Ivory\Tests\GoogleMap\Services\Timezones;

use Ivory\GoogleMap\Services\Timezones\TimezoneRequest;

/**
 * Class TimezoneRequestTest
 * @package Ivory\Tests\GoogleMap\Services\Timezones
 */
class TimezoneRequestTest extends \PHPUnit_Framework_TestCase
{
    // Test TimezoneRequest can be successfully instantiated and that it's property values match what's expected
    public function testTimezoneRequestIsValid()
    {
        $location = array( 'lat' => 45.340488, 'lng' => -75.912674 );
        $timestamp = time();
        $language = 'en';
        $key = 'mock_crypto_key';
        $request = new TimezoneRequest( $location, $timestamp, $key, $language );

        $this->assertEquals( $location, $request->getLocation() );
        $this->assertEquals( $timestamp, $request->getTimestamp() );
        $this->assertEquals( $key, $request->getKey() );
        $this->assertEquals( $language, $request->getLanguage() );
        $data = $request->toArray();
        $this->assertArrayHasKey( 'location', $data );
        $this->assertEquals( implode( ',', $location ), $data['location'] );
        $this->assertArrayHasKey( 'timestamp', $data );
        $this->assertEquals( $timestamp, $data['timestamp'] );
        $this->assertArrayHasKey( 'language', $data );
        $this->assertEquals( $language, $data['language'] );
        $this->assertArrayHasKey( 'key', $data );
        $this->assertEquals( $key, $data['key'] );
    }

    /**
     * Test that attempting to set the location with an empty array throws an InvalidArgumentException
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Location must include the lat and lng keys.
     */
    public function testInvalidLocation1() {
        $request = new TimezoneRequest( array() );
    }

    /**
     * Test that attempting to set the location with an invalid lat/long throws an InvalidArgumentException
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Location must contain numeric lat and lng values.
     */
    public function testInvalidLocation2() {
        $request = new TimezoneRequest( array( 'lat' => 'bad', 'lng' => -75.912674 ) );
    }

    /**
     * Test that attempting to set the timestamp with a non-numeric value throws an InvalidArgumentException
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Timestamp must be a integer.
     */
    public function testInvalidTimestamp() {
        $request = new TimezoneRequest( array( 'lat' => 45.340488, 'lng' => -75.912674 ), 'bad' );
    }

    /**
     * Test that attempting to set the key with a non-string value throws an InvalidArgumentException
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Key must be a string.
     */
    public function testInvalidKey() {
        $request = new TimezoneRequest( array( 'lat' => 45.340488, 'lng' => -75.912674 ), null, 123 );
    }

    /**
     * Test that attempting to set the language with null value throws an InvalidArgumentException
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Language is not valid.
     */
    public function testInvalidLanguage() {
        $request = new TimezoneRequest( array( 'lat' => 45.340488, 'lng' => -75.912674 ), null, null, null );
    }

}
