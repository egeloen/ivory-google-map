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
    /**
     * @var bool|null
     */
    private $openNow;

    /**
     * @var Period[]
     */
    private $periods = [];

    /**
     * @var string[]
     */
    private $weekdayTexts = [];

    /**
     * @return bool
     */
    public function hasOpenNow()
    {
        return $this->openNow !== null;
    }

    /**
     * @return bool|null
     */
    public function isOpenNow()
    {
        return $this->openNow;
    }

    /**
     * @param bool|null $openNow
     */
    public function setOpenNow($openNow)
    {
        $this->openNow = $openNow;
    }

    /**
     * @return bool
     */
    public function hasPeriods()
    {
        return !empty($this->periods);
    }

    /**
     * @return Period[]
     */
    public function getPeriods()
    {
        return $this->periods;
    }

    /**
     * @param Period[] $periods
     */
    public function setPeriods(array $periods)
    {
        $this->periods = [];
        $this->addPeriods($periods);
    }

    /**
     * @param Period[] $periods
     */
    public function addPeriods(array $periods)
    {
        foreach ($periods as $period) {
            $this->addPeriod($period);
        }
    }

    /**
     * @param Period $period
     *
     * @return bool
     */
    public function hasPeriod(Period $period)
    {
        return in_array($period, $this->periods, true);
    }

    /**
     * @param Period $period
     */
    public function addPeriod(Period $period)
    {
        if (!$this->hasPeriod($period)) {
            $this->periods[] = $period;
        }
    }

    /**
     * @param Period $period
     */
    public function removePeriod(Period $period)
    {
        unset($this->periods[array_search($period, $this->periods, true)]);
        $this->periods = array_values($this->periods);
    }

    /**
     * @return bool
     */
    public function hasWeekdayTexts()
    {
        return !empty($this->weekdayTexts);
    }

    /**
     * @return \string[]
     */
    public function getWeekdayTexts()
    {
        return $this->weekdayTexts;
    }

    /**
     * @param string[] $weekdayTexts
     */
    public function setWeekdayTexts(array $weekdayTexts)
    {
        $this->weekdayTexts = [];
        $this->addWeekdayTexts($weekdayTexts);
    }

    /**
     * @param string[] $weekdayTexts
     */
    public function addWeekdayTexts(array $weekdayTexts)
    {
        foreach ($weekdayTexts as $weekdayText) {
            $this->addWeekdayText($weekdayText);
        }
    }

    /**
     * @param string $weekdayText
     *
     * @return bool
     */
    public function hasWeekdayText($weekdayText)
    {
        return in_array($weekdayText, $this->weekdayTexts, true);
    }

    /**
     * @param string $weekdayText
     */
    public function addWeekdayText($weekdayText)
    {
        if (!$this->hasWeekdayText($weekdayText)) {
            $this->weekdayTexts[] = $weekdayText;
        }
    }

    /**
     * @param string $weekdayText
     */
    public function removeWeekdayText($weekdayText)
    {
        unset($this->weekdayTexts[array_search($weekdayText, $this->weekdayTexts, true)]);
        $this->weekdayTexts = array_values($this->weekdayTexts);
    }
}
