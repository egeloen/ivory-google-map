<?php

namespace Ivory\GoogleMap\Services\Base;

class TransitTime
{
    /** @var  string */
    protected $text;
    /** @var \DateTimeZone */
    protected $timezone;
    /** @var  int */
    protected $value;

    public function __construct($text, $timezone, $value)
    {
        $this->text = $text;
        $this->timezone = new \DateTimeZone($timezone);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return \DateTimeZone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param \DateTimeZone $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
