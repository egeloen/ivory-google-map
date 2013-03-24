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

use Buzz\Browser;
use Ivory\GoogleMap\Exception\ServiceException;

/**
 * Abstract class for accesing google API.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService
{
    /** @var \Buzz\Browser */
    protected $browser;

    /** @var string */
    protected $url;

    /** @var boolean */
    protected $https;

    /** @var string */
    protected $format;

    /**
     * Creates a service.
     *
     * @param string        $url     The service url.
     * @param boolean       $https   TRUE if the service uses HTTPS else FALSE.
     * @param string        $format  Format used by the service.
     * @param \Buzz\Browser $browser Buzz browser used by the service.
     */
    public function __construct($url, $https = false, $format = 'json', Browser $browser = null)
    {
        $this->setUrl($url);
        $this->setHttps($https);
        $this->setFormat($format);

        if ($browser === null) {
            $browser = new Browser();
        }

        $this->setBrowser($browser);
    }

    /**
     * Gets the buzz browser.
     *
     * @return \Buzz\Browser The buzz browser.
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Sets the buzz browser.
     *
     * @param \Buzz\Browser $browser The buzz browser.
     */
    public function setBrowser(Browser $browser)
    {
        $this->browser = $browser;
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
}
