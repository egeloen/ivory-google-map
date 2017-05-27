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
    private $coordinates = [];

    /**
     * @var IconSequence[]
     */
    private $iconSequences = [];

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

    /**
     * @return bool
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * @return Coordinate[]
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = [];
        $this->addCoordinates($coordinates);
    }

    /**
     * @param Coordinate[] $coordinates
     */
    public function addCoordinates($coordinates)
    {
        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * @param Coordinate $coordinate
     *
     * @return bool
     */
    public function hasCoordinate(Coordinate $coordinate)
    {
        return in_array($coordinate, $this->coordinates, true);
    }

    /**
     * @param Coordinate $coordinate
     */
    public function addCoordinate(Coordinate $coordinate)
    {
        $this->coordinates[] = $coordinate;
    }

    /**
     * @param Coordinate $coordinate
     */
    public function removeCoordinate(Coordinate $coordinate)
    {
        unset($this->coordinates[array_search($coordinate, $this->coordinates, true)]);
        $this->coordinates = empty($this->coordinates) ? [] : array_values($this->coordinates);
    }

    /**
     * @return bool
     */
    public function hasIconSequences()
    {
        return !empty($this->iconSequences);
    }

    /**
     * @return IconSequence[]
     */
    public function getIconSequences()
    {
        return $this->iconSequences;
    }

    /**
     * @param IconSequence[] $iconSequences
     */
    public function setIconSequences($iconSequences)
    {
        $this->iconSequences = [];
        $this->addIconSequences($iconSequences);
    }

    /**
     * @param IconSequence[] $iconSequences
     */
    public function addIconSequences($iconSequences)
    {
        foreach ($iconSequences as $iconSequence) {
            $this->addIconSequence($iconSequence);
        }
    }

    /**
     * @param IconSequence $iconSequence
     *
     * @return bool
     */
    public function hasIconSequence(IconSequence $iconSequence)
    {
        return in_array($iconSequence, $this->iconSequences, true);
    }

    /**
     * @param IconSequence $iconSequence
     */
    public function addIconSequence(IconSequence $iconSequence)
    {
        $this->iconSequences[] = $iconSequence;
    }

    /**
     * @param IconSequence $iconSequence
     */
    public function removeIconSequence(IconSequence $iconSequence)
    {
        unset($this->iconSequences[array_search($iconSequence, $this->iconSequences, true)]);
        $this->iconSequences = empty($this->iconSequences) ? [] : array_values($this->iconSequences);
    }
}
