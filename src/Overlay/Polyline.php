<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polyline
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polyline implements ExtendableInterface, OptionsAwareInterface, StaticOptionsAwareInterface
{
    use OptionsAwareTrait;
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var Coordinate[]
     */
    private array $coordinates = [];

    /**
     * @var IconSequence[]
     */
    private array $iconSequences = [];

    /**
     * @param Coordinate[]   $coordinates
     * @param IconSequence[] $icons
     * @param mixed[]        $options
     */
    public function __construct(array $coordinates = [], array $icons = [], array $options = [])
    {
        $this->addCoordinates($coordinates);
        $this->addIconSequences($icons);
        $this->addOptions($options);
    }

    public function hasCoordinates(): bool
    {
        return !empty($this->coordinates);
    }

    /**
     * @return Coordinate[]
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function setCoordinates($coordinates): void
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function addCoordinates($coordinates): void
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    public function hasCoordinate(Coordinate $coordinate): bool
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    public function addCoordinate(Coordinate $coordinate): void
    {
        $this->coordinates[] = $coordinate;
    }

    public function removeCoordinate(Coordinate $coordinate): void
    {
        unset($this->coordinates[array_search($coordinate, $this->coordinates, true)]);
        $this->coordinates = empty($this->coordinates) ? [] : array_values($this->coordinates);
    }

    public function hasIconSequences(): bool
    {
        return !empty($this->iconSequences);
    }

    /**
     * @return IconSequence[]
     */
    public function getIconSequences(): array
    {
        return $this->iconSequences;
    }

    /**
     * @param IconSequence[] $iconSequences
     */
    public function setIconSequences($iconSequences): void
    {
        $this->iconSequences = [];
        $this->addIconSequences($iconSequences);
    }

    /**
     * @param IconSequence[] $iconSequences
     */
    public function addIconSequences($iconSequences): void
    {
        foreach ($iconSequences as $iconSequence) {
            $this->addIconSequence($iconSequence);
        }
    }

    public function hasIconSequence(IconSequence $iconSequence): bool
    {
        return in_array($iconSequence, $this->iconSequences, true);
    }

    public function addIconSequence(IconSequence $iconSequence): void
    {
        $this->iconSequences[] = $iconSequence;
    }

    public function removeIconSequence(IconSequence $iconSequence): void
    {
        unset($this->iconSequences[array_search($iconSequence, $this->iconSequences, true)]);
        $this->iconSequences = empty($this->iconSequences) ? [] : array_values($this->iconSequences);
    }
}
