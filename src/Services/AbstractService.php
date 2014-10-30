<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services;

use Ivory\GoogleMap\Exception\ServiceException;
use Ivory\GoogleMap\Services\Utils\XmlParser;
use Widop\HttpAdapter\HttpAdapterInterface;

/**
 * Abstract class for accesing google API.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService
{
    /** @var \Widop\HttpAdapter\HttpAdapterInterface */
    protected $httpAdapter;

    /** @var string */
    protected $url;

    /** @var boolean */
    protected $https;

    /** @var string */
    protected $format;

    /** @var \Ivory\GoogleMap\Services\Utils\XmlParser */
    protected $xmlParser;

    /** @var \Ivory\GoogleMap\Services\BusinessAccount */
    protected $businessAccount;

    /**
     * Creates a service.
     *
     * @param \Widop\HttpAdapter\HttpAdapterInterface   $httpAdapter     The http adapter.
     * @param string                                    $url             The service url.
     * @param boolean                                   $https           TRUE if the service uses HTTPS else FALSE.
     * @param string                                    $format          Format used by the service.
     * @param \Ivory\GoogleMap\Services\Utils\XmlParser $xmlParser       The xml parser.
     * @param \Ivory\GoogleMap\Services\BusinessAccount $businessAccount The business account.
     */
    public function __construct(
        HttpAdapterInterface $httpAdapter,
        $url,
        $https = false,
        $format = 'json',
        XmlParser $xmlParser = null,
        BusinessAccount $businessAccount = null
    ) {
        if ($xmlParser === null) {
            $xmlParser = new XmlParser();
        }

        $this->setHttpAdapter($httpAdapter);
        $this->setUrl($url);
        $this->setHttps($https);
        $this->setFormat($format);
        $this->setXmlParser($xmlParser);
        $this->setBusinessAccount($businessAccount);
    }

    /**
     * Gets the http adapter.
     *
     * @return \Widop\HttpAdapter\HttpAdapterInterface The http adapter.
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
    }

    /**
     * Sets the http adapter.
     *
     * @param \Widop\HttpAdapter\HttpAdapterInterface $httpAdapter The http adapter.
     */
    public function setHttpAdapter(HttpAdapterInterface $httpAdapter)
    {
        $this->httpAdapter = $httpAdapter;
    }

    /**
     * Gets the service API url according to the https flag.
     *
     * @return string The service API url.
     */
    public function getUrl()
    {
        if ($this->isHttps()) {
            return str_replace('http://', 'https://', $this->url);
        }

        return $this->url;
    }

    /**
     * Sets the service API url.
     *
     * @param string $url The service API url.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the url is not valid.
     */
    public function setUrl($url)
    {
        if (!is_string($url)) {
            throw ServiceException::invalidServiceUrl();
        }

        $this->url = $url;
    }

    /**
     * Checks if the service uses HTTPS.
     *
     * @return boolean TRUE if the service uses HTTPS else FALSE.
     */
    public function isHttps()
    {
        return $this->https;
    }

    /**
     * Sets the service HTTPS flag.
     *
     * @param boolean $https TRUE if the service uses HTTPS else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the https flag is not valid.
     */
    public function setHttps($https)
    {
        if (!is_bool($https)) {
            throw ServiceException::invalidServiceHttps();
        }

        $this->https = $https;
    }

    /**
     * Gets the service format.
     *
     * @return string The service format.
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the service format
     *
     * @param string $format The service format.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the format is not valid.
     */
    public function setFormat($format)
    {
        if (!in_array($format, array('json', 'xml'))) {
            throw ServiceException::invalidServiceFormat();
        }

        $this->format = $format;
    }

    /**
     * Gets the xml parser.
     *
     * @return \Ivory\GoogleMap\Services\Utils\XmlParser The xml parser.
     */
    public function getXmlParser()
    {
        return $this->xmlParser;
    }

    /**
     * Sets the xml parser.
     *
     * @param \Ivory\GoogleMap\Services\Geocoding\XmlParser $xmlParser The xml parser.
     */
    public function setXmlParser(XmlParser $xmlParser)
    {
        $this->xmlParser = $xmlParser;
    }

    /**
     * Checks if the service has a business account.
     *
     * @return boolean TRUE if the service has a business account else FALSE.
     */
    public function hasBusinessAccount()
    {
        return $this->businessAccount !== null;
    }

    /**
     * Gets the business account.
     *
     * @return \Ivory\GoogleMap\Services\BusinessAccount The business account.
     */
    public function getBusinessAccount()
    {
        return $this->businessAccount;
    }

    /**
     * Sets the business account.
     *
     * @param \Ivory\GoogleMap\Services\BusinessAccount $businessAccount The business account.
     */
    public function setBusinessAccount(BusinessAccount $businessAccount = null)
    {
        $this->businessAccount = $businessAccount;
    }

    /**
     * Sign an url for business account.
     *
     * @param string $url The url.
     *
     * @return string The signed url.
     */
    protected function signUrl($url)
    {
        if (!$this->hasBusinessAccount()) {
            return $url;
        }

        return $this->businessAccount->signUrl($url);
    }

    /**
     * Sends a service request.
     *
     * @param string $url The service url.
     *
     * @return \Widop\HttpAdapter\HttpResponse The response.
     *
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the response is null.
     * @throws \Ivory\GoogleMap\Exception\ServiceException If the response has an error 4XX or 5XX.
     */
    protected function send($url)
    {
        $response = $this->httpAdapter->getContent($url);

        if ($response === null) {
            throw ServiceException::invalidServiceResult();
        }

        $statusCode = (string) $response->getStatusCode();

        if ($statusCode[0] === '4' || $statusCode[0] === '5') {
            throw ServiceException::invalidResponse($url, $statusCode);
        }

        return $response;
    }
}
