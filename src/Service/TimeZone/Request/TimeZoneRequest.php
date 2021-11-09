<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\TimeZone\Request;

use DateTime;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneRequest implements TimeZoneRequestInterface
{
    private ?Coordinate $location = null;

    private ?DateTime $date = null;

    private ?string $language = null;

    /**
     * @param DateTime|null $date
     */
    public function __construct(Coordinate $location, DateTime $date = null)
    {
        $this->setLocation($location);
        $this->setDate($date);
    }

    public function getLocation(): Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location): void
    {
        $this->location = $location;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function hasLanguage(): bool
    {
        return $this->language !== null;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed[]
     */
    public function buildQuery(): array
    {
        $query = [
            'location'  => $this->buildCoordinate($this->location),
            'timestamp' => $this->date->getTimestamp(),
        ];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    private function buildCoordinate(Coordinate $coordinate): string
    {
        return $coordinate->getLatitude().','.$coordinate->getLongitude();
    }
}
