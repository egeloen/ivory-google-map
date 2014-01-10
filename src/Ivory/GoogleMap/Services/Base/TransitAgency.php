<?php

namespace Ivory\GoogleMap\Services\Base;

class TransitAgency
{
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $phone;
    /** @var  string */
    protected $url;

    public function __construct($name, $phone, $url)
    {

        $this->name = $name;
        $this->phone = $phone;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
