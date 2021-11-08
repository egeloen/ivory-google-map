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
    private array $paths = [];

    private ?int $samples = null;

    /**
     * @param LocationInterface[] $paths
     * @param int                 $samples
     */
    public function __construct(array $paths, $samples = 3)
    {
        $this->setPaths($paths);
        $this->setSamples($samples);
    }

    public function hasPaths(): bool
    {
        return !empty($this->paths);
    }

    /**
     * @return LocationInterface[]
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    /**
     * @param LocationInterface[] $paths
     */
    public function setPaths(array $paths): void
    {
        $this->paths = [];
        $this->addPaths($paths);
    }

    /**
     * @param LocationInterface[] $paths
     */
    public function addPaths(array $paths): void
    {
        foreach ($paths as $path) {
            $this->addPath($path);
        }
    }

    public function hasPath(LocationInterface $path): bool
    {
        return in_array($path, $this->paths, true);
    }

    public function addPath(LocationInterface $path): void
    {
        if (!$this->hasPath($path)) {
            $this->paths[] = $path;
        }
    }

    public function removePath(LocationInterface $path): void
    {
        unset($this->paths[array_search($path, $this->paths, true)]);
        $this->paths = empty($this->paths) ? [] : array_values($this->paths);
    }

    public function getSamples(): ?int
    {
        return $this->samples;
    }

    /**
     * @param int $samples
     */
    public function setSamples($samples): void
    {
        $this->samples = $samples;
    }

    public function buildQuery(): array
    {
        return [
            'path' => implode('|', array_map(fn(LocationInterface $path) => $path->buildQuery(), $this->paths)),
            'samples' => $this->samples,
        ];
    }
}
