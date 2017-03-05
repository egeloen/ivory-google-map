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

use Ivory\GoogleMap\Service\Plugin\Scaler\Context\ContextInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ConfigInterface
{
    const FLAG_KEY = ContextInterface::CONTEXT_KEY;
    const FLAG_SERVICE = ContextInterface::CONTEXT_SERVICE;

    /**
     * @return int
     */
    public function getPeriod();

    /**
     * @param int $period
     */
    public function setPeriod($period);

    /**
     * @return int
     */
    public function getQueryPerPeriod();

    /**
     * @param int $queryPerPeriod
     */
    public function setQueryPerPeriod($queryPerPeriod);

    /**
     * @return int
     */
    public function getCoefficient();

    /**
     * @param int $coefficient
     */
    public function setCoefficient($coefficient);

    /**
     * @return int
     */
    public function getFlag();

    /**
     * @param int $flag
     */
    public function setFlag($flag);
}
