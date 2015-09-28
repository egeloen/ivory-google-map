<?php
/**
 * TimezoneProvider.php Class
 *
 * Date: 2015-09-22
 * Time: 2:40 PM
 */

namespace Ivory\GoogleMap\Services\Timezones;

use Ivory\GoogleMap\Services\BusinessAccount;
use Widop\HttpAdapter\HttpAdapterInterface;
use Widop\HttpAdapter\HttpResponse;

/**
 * Class TimezoneProvider
 * @package Ivory\GoogleMap\Services\Timezones
 */
class TimezoneProvider
{
    /** @var string */
    protected $url;

    /** @var string */
    protected $format;

    /** @var BusinessAccount */
    protected $businessAccount;

    /** @var HttpAdapterInterface */
    protected $adapter = null;

    /** @param HttpAdapterInterface $adapter */
    public function __construct( HttpAdapterInterface $adapter )
    {
        $this->setUrl( 'https://maps.googleapis.com/maps/api/timezone' );
        $this->setFormat( 'json' );
        $this->setAdapter( $adapter );
    }

    /**
     * Sets the service url
     *
     * @param string $url
     */
    public function setUrl( $url )
    {
        if ( filter_var( $url, FILTER_VALIDATE_URL ) === false ) {
            throw new \InvalidArgumentException( 'Service URL is invalid.' );
        }

        $this->url = $url;
    }

    /**
     * Gets the service url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the service format
     *
     * @param string $format
     */
    protected function setFormat( $format )
    {
        $this->format = $format;
    }

    /**
     * Gets the service format
     *
     * @return string
     */
    protected function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the HTTP adapter to be used for further requests.
     *
     * @param HttpAdapterInterface $adapter
     */
    public function setAdapter( HttpAdapterInterface $adapter )
    {
        $this->adapter = $adapter;
    }

    /**
     * Returns the HTTP adapter
     *
     * @return HttpAdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Sets the business account
     *
     * @param \Ivory\GoogleMap\Services\BusinessAccount $businessAccount The business account.
     */
    public function setBusinessAccount( BusinessAccount $businessAccount = null )
    {
        $this->businessAccount = $businessAccount;
    }

    /**
     * Gets the business account
     *
     * @return \Ivory\GoogleMap\Services\BusinessAccount The business account.
     */
    public function getBusinessAccount()
    {
        return $this->businessAccount;
    }

    /**
     * Make a GET request to the Time Zone API
     *
     * @param TimezoneRequest $request
     * @return TimezoneResponse
     */
    public function getTimezoneData( TimezoneRequest $request )
    {
        $url = $this->generateUrl( $request );
        $response = $this->getAdapter()->getContent( $url );

        return new TimezoneResponse( $this->parse( $response ) );
    }

    /**
     * Checks if their is a business account
     *
     * @return bool
     */
    public function hasBusinessAccount()
    {
        return $this->businessAccount !== null;
    }

    /**
     * Generate the API url containing the required query params
     *
     * @param TimezoneRequest $request
     * @return string
     */
    protected function generateUrl( TimezoneRequest $request )
    {
        $url = sprintf( '%s/%s?%s', $this->getUrl(), $this->getFormat(), http_build_query( $request->toArray() ) );

        return $this->signUrl( $url );
    }

    /**
     * Sign an url for business account
     *
     * @param $url
     * @return string
     */
    protected function signUrl( $url )
    {
        if ( ! $this->hasBusinessAccount() ) {
            return $url;
        }

        return $this->businessAccount->signUrl( $url );
    }

    /**
     * Parses & normalizes the Time Zone API response
     *
     * @param $response
     * @return array
     */
    protected function parse( HttpResponse $response )
    {
        return json_decode( $response->getBody(), true );
    }

}
