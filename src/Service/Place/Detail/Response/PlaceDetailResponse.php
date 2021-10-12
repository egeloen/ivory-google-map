<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Detail\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailResponse
{
    private ?string $status = null;

    private ?PlaceDetailRequestInterface $request = null;

    private ?Place $result = null;

    /**
     * @var string[]
     */
    private array $htmlAttributions = [];

    public function hasStatus(): bool
    {
        return $this->status !== null;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return $this->request !== null;
    }

    public function getRequest(): ?PlaceDetailRequestInterface
    {
        return $this->request;
    }

    /**
     * @param PlaceDetailRequestInterface|null $request
     */
    public function setRequest(PlaceDetailRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResult(): bool
    {
        return $this->result !== null;
    }

    public function getResult(): ?Place
    {
        return $this->result;
    }

    /**
     * @param Place|null $result
     */
    public function setResult(Place $result = null): void
    {
        $this->result = $result;
    }

    public function hasHtmlAttributions(): bool
    {
        return !empty($this->htmlAttributions);
    }

    /**
     * @return string[]
     */
    public function getHtmlAttributions(): array
    {
        return $this->htmlAttributions;
    }

    /**
     * @param string[] $htmlAttributions
     */
    public function setHtmlAttributions(array $htmlAttributions): void
    {
        $this->htmlAttributions = [];
        $this->addHtmlAttributions($htmlAttributions);
    }

    /**
     * @param string[] $htmlAttributions
     */
    public function addHtmlAttributions(array $htmlAttributions): void
    {
        foreach ($htmlAttributions as $htmlAttribution) {
            $this->addHtmlAttribution($htmlAttribution);
        }
    }

    /**
     * @param string $htmlAttribution
     */
    public function hasHtmlAttribution($htmlAttribution): bool
    {
        return in_array($htmlAttribution, $this->htmlAttributions, true);
    }

    /**
     * @param string $htmlAttribution
     */
    public function addHtmlAttribution($htmlAttribution): void
    {
        if (!$this->hasHtmlAttribution($htmlAttribution)) {
            $this->htmlAttributions[] = $htmlAttribution;
        }
    }

    /**
     * @param string $htmlAttribution
     */
    public function removeHtmlAttribution($htmlAttribution): void
    {
        unset($this->htmlAttributions[array_search($htmlAttribution, $this->htmlAttributions, true)]);
        $this->htmlAttributions = empty($this->htmlAttributions) ? [] : array_values($this->htmlAttributions);
    }
}
