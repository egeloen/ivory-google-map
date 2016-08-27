<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Elevation\Request;

use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PathElevationRequest implements ElevationRequestInterface
{
    /**
     * @var LocationInterface[]
     */
    private $paths = [];

    /**
     * @var int
     */
    private $samples;

    /**
     * @param LocationInterface[] $paths
     * @param int                 $samples
     */
    public function __construct(array $paths, $samples = 3)
    {
        $this->setPaths($paths);
        $this->setSamples($samples);
    }

    /**
     * @return bool
     */
    public function hasPaths()
    {
        return !empty($this->paths);
    }

    /**
     * @return LocationInterface[]
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @param LocationInterface[] $paths
     */
    public function setPaths(array $paths)
    {
        $this->paths = [];
        $this->addPaths($paths);
    }

    /**
     * @param LocationInterface[] $paths
     */
    public function addPaths(array $paths)
    {
        foreach ($paths as $path) {
            $this->addPath($path);
        }
    }

    /**
     * @param LocationInterface $path
     *
     * @return bool
     */
    public function hasPath(LocationInterface $path)
    {
        return in_array($path, $this->paths, true);
    }

    /**
     * @param LocationInterface $path
     */
    public function addPath(LocationInterface $path)
    {
        if (!$this->hasPath($path)) {
            $this->paths[] = $path;
        }
    }

    /**
     * @param LocationInterface $path
     */
    public function removePath(LocationInterface $path)
    {
        unset($this->paths[array_search($path, $this->paths, true)]);
        $this->paths = array_values($this->paths);
    }

    /**
     * @return int
     */
    public function getSamples()
    {
        return $this->samples;
    }

    /**
     * @param int $samples
     */
    public function setSamples($samples)
    {
        $this->samples = $samples;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        return [
            'path' => implode('|', array_map(function (LocationInterface $path) {
                return $path->buildQuery();
            }, $this->paths)),
            'samples' => $this->samples,
        ];
    }
}
