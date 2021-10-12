<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OpeningHours
{
    private ?bool $openNow = null;

    /**
     * @var Period[]
     */
    private array $periods = [];

    /**
     * @var string[]
     */
    private array $weekdayTexts = [];

    public function hasOpenNow(): bool
    {
        return $this->openNow !== null;
    }

    public function isOpenNow(): ?bool
    {
        return $this->openNow;
    }

    /**
     * @param bool|null $openNow
     */
    public function setOpenNow($openNow): void
    {
        $this->openNow = $openNow;
    }

    public function hasPeriods(): bool
    {
        return !empty($this->periods);
    }

    /**
     * @return Period[]
     */
    public function getPeriods(): array
    {
        return $this->periods;
    }

    /**
     * @param Period[] $periods
     */
    public function setPeriods(array $periods): void
    {
        $this->periods = [];
        $this->addPeriods($periods);
    }

    /**
     * @param Period[] $periods
     */
    public function addPeriods(array $periods): void
    {
        foreach ($periods as $period) {
            $this->addPeriod($period);
        }
    }

    public function hasPeriod(Period $period): bool
    {
        return in_array($period, $this->periods, true);
    }

    public function addPeriod(Period $period): void
    {
        if (!$this->hasPeriod($period)) {
            $this->periods[] = $period;
        }
    }

    public function removePeriod(Period $period): void
    {
        unset($this->periods[array_search($period, $this->periods, true)]);
        $this->periods = empty($this->periods) ? [] : array_values($this->periods);
    }

    public function hasWeekdayTexts(): bool
    {
        return !empty($this->weekdayTexts);
    }

    /**
     * @return \string[]
     */
    public function getWeekdayTexts(): array
    {
        return $this->weekdayTexts;
    }

    /**
     * @param string[] $weekdayTexts
     */
    public function setWeekdayTexts(array $weekdayTexts): void
    {
        $this->weekdayTexts = [];
        $this->addWeekdayTexts($weekdayTexts);
    }

    /**
     * @param string[] $weekdayTexts
     */
    public function addWeekdayTexts(array $weekdayTexts): void
    {
        foreach ($weekdayTexts as $weekdayText) {
            $this->addWeekdayText($weekdayText);
        }
    }

    /**
     * @param string $weekdayText
     */
    public function hasWeekdayText($weekdayText): bool
    {
        return in_array($weekdayText, $this->weekdayTexts, true);
    }

    /**
     * @param string $weekdayText
     */
    public function addWeekdayText($weekdayText): void
    {
        if (!$this->hasWeekdayText($weekdayText)) {
            $this->weekdayTexts[] = $weekdayText;
        }
    }

    /**
     * @param string $weekdayText
     */
    public function removeWeekdayText($weekdayText): void
    {
        unset($this->weekdayTexts[array_search($weekdayText, $this->weekdayTexts, true)]);
        $this->weekdayTexts = empty($this->weekdayTexts) ? [] : array_values($this->weekdayTexts);
    }
}
