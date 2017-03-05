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
class Config implements ConfigInterface
{
    /**
     * @var int
     */
    private $period;

    /**
     * @var int
     */
    private $queryPerPeriod;

    /**
     * @var int
     */
    private $coefficient;

    /**
     * @var int
     */
    private $flag;

    /**
     * @param int $period
     * @param int $queryPerPeriod
     * @param int $coefficient
     * @param int $flag
     */
    public function __construct(
        $period = 1,
        $queryPerPeriod = 50,
        $coefficient = 1,
        $flag = self::FLAG_KEY | self::FLAG_SERVICE
    ) {
        $this->setPeriod($period);
        $this->setQueryPerPeriod($queryPerPeriod);
        $this->setCoefficient($coefficient);
        $this->setFlag($flag);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * {@inheritdoc}
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryPerPeriod()
    {
        return $this->queryPerPeriod;
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryPerPeriod($queryPerPeriod)
    {
        $this->queryPerPeriod = $queryPerPeriod;
    }

    /**
     * {@inheritdoc}
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * {@inheritdoc}
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * {@inheritdoc}
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * {@inheritdoc}
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }
}
