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

use DateTime;
/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Time
{
    private ?DateTime $value = null;

    private ?string $timeZone = null;

    private ?string $text = null;

    /**
     * @param string    $timeZone
     * @param string    $text
     */
    public function __construct(DateTime $value, $timeZone, $text)
    {
        $this->setValue($value);
        $this->setTimeZone($timeZone);
        $this->setText($text);
    }

    public function getValue(): DateTime
    {
        return $this->value;
    }

    public function setValue(DateTime $value): void
    {
        $this->value = $value;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     */
    public function setTimeZone($timeZone): void
    {
        $this->timeZone = $timeZone;
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}
