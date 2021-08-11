<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionWaypoint
{
    private ?Coordinate $location = null;

    private ?int $stepIndex = null;

    private ?float $stepInterpolation = null;

    public function hasLocation(): bool
    {
        return $this->location !== null;
    }

    public function getLocation(): ?Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location): void
    {
        $this->location = $location;
    }

    public function hasStepIndex(): bool
    {
        return $this->stepIndex !== null;
    }

    public function getStepIndex(): ?int
    {
        return $this->stepIndex;
    }

    /**
     * @param int|null $stepIndex
     */
    public function setStepIndex($stepIndex): void
    {
        $this->stepIndex = $stepIndex;
    }

    public function hasStepInterpolation(): bool
    {
        return $this->stepInterpolation !== null;
    }

    public function getStepInterpolation(): ?float
    {
        return $this->stepInterpolation;
    }

    /**
     * @param float|null $stepInterpolation
     */
    public function setStepInterpolation($stepInterpolation): void
    {
        $this->stepInterpolation = $stepInterpolation;
    }
}
