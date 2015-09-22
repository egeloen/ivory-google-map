<?php
/**
 * TimezoneProviderTest.php Class
 *
 * Date: 2015-09-25
 * Time: 11:16 AM
 */

namespace Ivory\Tests\GoogleMap\Services\Timezones;

use Ivory\GoogleMap\Services\Timezones\TimezoneRequest;
use Widop\HttpAdapter\HttpResponse;
use Ivory\GoogleMap\Services\Timezones\TimezoneProvider;
use Ivory\GoogleMap\Services\BusinessAccount;

/**
 * Class TimezoneProviderTest
 * @package Ivory\Tests\GoogleMap\Services\Timezones
 */
class TimezoneProviderTest extends \PHPUnit_Framework_TestCase
{
    const API_BASE_URL = 'https://maps.googleapis.com/maps/api/timezone';

    /** @var TimezoneProvider */
    protected $timeZoneProvider;

    protected function setUp()
    {
        // Mock up an HttpResponse's JSON body
        $responseData = array(
            'dstOffset'  => 0,
            'rawOffset'  => -28800,
            'status'     => 'OK',
            'timeZoneId' => 'America/Los_Angeles',
            'timeZoneName'   => 'Pacific Standard Time',
        );
        $mockHttpResponse = new HttpResponse( 200, self::API_BASE_URL, array(), json_encode( $responseData ) );

        // Mock up a GuzzleHttpAdapter
        $mockGuzzle = $this->getMockBuilder( 'Widop\HttpAdapter\GuzzleHttpAdapter' )->disableOriginalConstructor()->getMock();
        $mockGuzzle->method( 'getContent' )->willReturn( $mockHttpResponse );

        $this->timeZoneProvider = new TimezoneProvider( $mockGuzzle );
    }

    // Test TimezoneProvider's getters
    public function testTimezoneProviderGetters()
    {
        $this->assertEquals( self::API_BASE_URL, $this->timeZoneProvider->getUrl() );
        $this->assertInstanceOf( 'Widop\HttpAdapter\GuzzleHttpAdapter', $this->timeZoneProvider->getAdapter() );
        $this->assertFalse( $this->timeZoneProvider->hasBusinessAccount() );
        $this->timeZoneProvider->setBusinessAccount( new BusinessAccount( 'mock_client_id', 'mock_crypto_key' ) );
        $this->assertTrue( $this->timeZoneProvider->hasBusinessAccount() );
        $this->assertInstanceOf( 'Ivory\GoogleMap\Services\BusinessAccount', $this->timeZoneProvider->getBusinessAccount() );
        $this->assertInstanceOf( 'Ivory\GoogleMap\Services\Timezones\TimezoneResponse', $this->timeZoneProvider->getTimezoneData( new TimezoneRequest( array( 'lat' => 39.6034810, 'lng' =>  -119.6822510 ) ) ) );
    }

    /**
     * Test TimezoneProvider's setUrl() method expects a valid URL
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Service URL is invalid.
     */
    public function testTimezoneProviderInvalidUrl()
    {
        $this->timeZoneProvider->setUrl( 'foo' );
    }

}
