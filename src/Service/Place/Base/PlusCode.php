<?php


namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author Mark Bijl <mark.bijl@validaide.com>
 */
final class PlusCode
{
    private ?string $globalCode = null;

    private ?string $compoundCode = null;

    public function getGlobalCode(): ?string
    {
        return $this->globalCode;
    }

    /**
     * @param string|null $globalCode
     */
    public function setGlobalCode(string $globalCode): void
    {
        $this->globalCode = $globalCode;
    }

    public function getCompoundCode(): ?string
    {
        return $this->compoundCode;
    }

    /**
     * @param string|null $compoundCode
     */
    public function setCompoundCode(string $compoundCode): void
    {
        $this->compoundCode = $compoundCode;
    }
}
