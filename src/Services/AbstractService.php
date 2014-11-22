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

use Ivory\HttpAdapter\Event\Subscriber\StatusCodeSubscriber;
use Ivory\HttpAdapter\HttpAdapterInterface;

/**
 * Abstract class for accesing google API.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService
{
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';

    /** @var \Ivory\HttpAdapter\HttpAdapterInterface */
    private $httpAdapter;

    /** @var string */
    private $url;

    /** @var boolean */
    private $https;

    /** @var string */
    private $format;

    /** @var \Ivory\GoogleMap\Services\XmlParser */
    private $xmlParser;

    /** @var \Ivory\GoogleMap\Services\BusinessAccount */
    private $businessAccount;

    /**
     * Creates a service.
     *
     * @param \Ivory\HttpAdapter\HttpAdapterInterface   $httpAdapter     The http adapter.
     * @param string                                    $url             The url.
     * @param boolean                                   $https           TRUE if it uses https else FALSE.
     * @param string                                    $format          The format.
     * @param \Ivory\GoogleMap\Services\XmlParser       $xmlParser       The xml parser.
     * @param \Ivory\GoogleMap\Services\BusinessAccount $businessAccount The business account.
     */
    public function __construct(
        HttpAdapterInterface $httpAdapter,
        $url,
        $https = false,
        $format = self::FORMAT_JSON,
        XmlParser $xmlParser = null,
        BusinessAccount $businessAccount = null
    ) {
        $this->setHttpAdapter($httpAdapter);
        $this->setUrl($url);
        $this->setHttps($https);
        $this->setFormat($format);
        $this->setXmlParser($xmlParser ?: new XmlParser());
        $this->setBusinessAccount($businessAccount);
    }

    /**
     * Gets the http adapter.
     *
     * @return \Ivory\HttpAdapter\HttpAdapterInterface The http adapter.
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
    }

    /**
     * Sets the http adapter.
     *
     * @param \Ivory\HttpAdapter\HttpAdapterInterface $httpAdapter The http adapter.
     */
    public function setHttpAdapter(HttpAdapterInterface $httpAdapter)
    {
        $httpAdapter->getConfiguration()->getEventDispatcher()->addSubscriber(new StatusCodeSubscriber());

        $this->httpAdapter = $httpAdapter;
    }

    /**
     * Gets the url.
     *
     * @return string The url.
     */
    public function getUrl()
    {
        return $this->isHttps() ? str_replace('http://', 'https://', $this->url) : $this->url;
    }

    /**
     * Sets the url.
     *
     * @param string $url The url.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Checks if it uses https.
     *
     * @return boolean TRUE if it uses https else FALSE.
     */
    public function isHttps()
    {
        return $this->https;
    }

    /**
     * Sets if it uses https.
     *
     * @param boolean $https TRUE if it uses https else FALSE.
     */
    public function setHttps($https)
    {
        $this->https = $https;
    }

    /**
     * Gets the format.
     *
     * @return string The format.
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the format
     *
     * @param string $format The format.
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Gets the xml parser.
     *
     * @return \Ivory\GoogleMap\Services\XmlParser The xml parser.
     */
    public function getXmlParser()
    {
        return $this->xmlParser;
    }

    /**
     * Sets the xml parser.
     *
     * @param \Ivory\GoogleMap\Services\XmlParser $xmlParser The xml parser.
     */
    public function setXmlParser(XmlParser $xmlParser)
    {
        $this->xmlParser = $xmlParser;
    }

    /**
     * Checks if it has a business account.
     *
     * @return boolean TRUE if it has a business account else FALSE.
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
     * @param \Ivory\GoogleMap\Services\BusinessAccount|null $businessAccount The business account.
     */
    public function setBusinessAccount(BusinessAccount $businessAccount = null)
    {
        $this->businessAccount = $businessAccount;
    }

    /**
     * Sign the url.
     *
     * @param string $url The url.
     *
     * @return string The signed url.
     */
    protected function signUrl($url)
    {
        return $this->hasBusinessAccount() ? $this->businessAccount->signUrl($url) : $url;
    }
}
