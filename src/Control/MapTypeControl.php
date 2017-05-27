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
    private $ids = [];

    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $style;

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

    /**
     * @return bool
     */
    public function hasIds()
    {
        return !empty($this->ids);
    }

    /**
     * @return string[]
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param string[] $ids
     */
    public function setIds(array $ids)
    {
        $this->ids = [];
        $this->addIds($ids);
    }

    /**
     * @param string[] $ids
     */
    public function addIds(array $ids)
    {
        foreach ($ids as $mapTypeId) {
            $this->addId($mapTypeId);
        }
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function hasId($id)
    {
        return in_array($id, $this->ids, true);
    }

    /**
     * @param string $id
     */
    public function addId($id)
    {
        if (!$this->hasId($id)) {
            $this->ids[] = $id;
        }
    }

    /**
     * @param string $id
     */
    public function removeId($id)
    {
        unset($this->ids[array_search($id, $this->ids, true)]);
        $this->ids = empty($this->ids) ? [] : array_values($this->ids);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }
}
