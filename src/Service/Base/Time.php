<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Time
{
    /**
     * @var \DateTime
     */
    private $value;

    /**
     * @var string
     */
    private $timeZone;

    /**
     * @var string
     */
    private $text;

    /**
     * @param \DateTime $value
     * @param string    $timeZone
     * @param string    $text
     */
    public function __construct(\DateTime $value, $timeZone, $text)
    {
        $this->setValue($value);
        $this->setTimeZone($timeZone);
        $this->setText($text);
    }

    /**
     * @return \DateTime
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param \DateTime $value
     */
    public function setValue(\DateTime $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
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
}
