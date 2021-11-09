<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

use Ivory\GoogleMap\MapTypeId;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeControlOptions
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControl
{
    /**
     * @var string[]
     */
    private array $ids = [];

    private ?string $position = null;

    private ?string $style = null;

    /**
     * @param string[] $ids
     * @param string   $position
     * @param string   $style
     */
    public function __construct(
        array $ids = [MapTypeId::ROADMAP, MapTypeId::SATELLITE],
        $position = ControlPosition::TOP_RIGHT,
        $style = MapTypeControlStyle::DEFAULT_
    ) {
        $this->addIds($ids);
        $this->setPosition($position);
        $this->setStyle($style);
    }

    public function hasIds(): bool
    {
        return !empty($this->ids);
    }

    /**
     * @return string[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @param string[] $ids
     */
    public function setIds(array $ids): void
    {
        $this->ids = [];
        $this->addIds($ids);
    }

    /**
     * @param string[] $ids
     */
    public function addIds(array $ids): void
    {
        foreach ($ids as $mapTypeId) {
            $this->addId($mapTypeId);
        }
    }

    /**
     * @param string $id
     */
    public function hasId($id): bool
    {
        return in_array($id, $this->ids, true);
    }

    /**
     * @param string $id
     */
    public function addId($id): void
    {
        if (!$this->hasId($id)) {
            $this->ids[] = $id;
        }
    }

    /**
     * @param string $id
     */
    public function removeId($id): void
    {
        unset($this->ids[array_search($id, $this->ids, true)]);
        $this->ids = empty($this->ids) ? [] : array_values($this->ids);
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     */
    public function setStyle($style): void
    {
        $this->style = $style;
    }
}
