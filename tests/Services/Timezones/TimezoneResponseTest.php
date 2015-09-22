<?php
/**
 * TimezoneResponseTest.php Class
 *
 * Date: 2015-09-25
 * Time: 3:41 PM
 */

namespace Ivory\Tests\GoogleMap\Services\Timezones;

use Ivory\GoogleMap\Services\Timezones\TimezoneResponse;

/**
 * Class TimezoneResponseTest
 * @package Ivory\Tests\GoogleMap\Services\Timezones
 */
class TimezoneResponseTest extends \PHPUnit_Framework_TestCase
{
    // Test TimezoneResponse can be successfully instantiated and that it's property values match what's expected
    public function testTimezoneResponseIsValid()
    {
        // Mock up the data we'd expect from the API
        $responseData = array(
           'dstOffset'  => 0,
           'rawOffset'  => -28800,
           'status'     => 'OK',
           'timeZoneId' => 'America/Los_Angeles',
           'timeZoneName'   => 'Pacific Standard Time',
        );
        $response = new TimezoneResponse( $responseData );

        $this->assertEquals( $responseData['dstOffset'], $response->dstOffset );
        $this->assertEquals( $responseData['rawOffset'], $response->rawOffset );
        $this->assertEquals( $responseData['status'], $response->status );
        $this->assertEquals( $responseData['timeZoneId'], $response->timeZoneId );
        $this->assertEquals( $responseData['timeZoneName'], $response->timeZoneName );
        $this->assertTrue( $response->toArray() === $responseData );
        $this->assertNull( $response->foo );
    }

    /**
     * Test TimezoneResponse's constructor throws an \InvalidArgumentException when trying to instantiate with a non-object and non-array argument
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage TimezoneResponse received empty attributes.
     */
    public function testTimezoneResponseIsInvalid()
    {
        $response = new TimezoneResponse( array() );
    }

}
