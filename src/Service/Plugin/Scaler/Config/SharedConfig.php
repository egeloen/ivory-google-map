<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Plugin\Scaler\Config;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SharedConfig extends Config
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        $period = 86400,
        $queryPerPeriod = 100000,
        $coefficient = 0,
        $flag = self::FLAG_KEY
    ) {
        parent::__construct($period, $queryPerPeriod, $coefficient, $flag);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriod()
    {
        $period = parent::getPeriod();

        if ($period === 86400) {
            return time() - (new \DateTime('yesterday 12:00 AM PST'))->getTimestamp();
        }

        return $period;
    }
}
