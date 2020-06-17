<?php


namespace Ivory\GoogleMap\Service\Place\Base;

/**
 * @author Mark Bijl <mark.bijl@validaide.com>
 */
final class PlusCode
{
    /**
     * @var string|null
     */
    private $globalCode;

    /**
     * @var string|null
     */
    private $compoundCode;

    /**
     * @return string|null
     */
    public function getGlobalCode(): string
    {
        return $this->globalCode;
    }

    /**
     * @param string|null $globalCode
     */
    public function setGlobalCode(string $globalCode)
    {
        $this->globalCode = $globalCode;
    }

    /**
     * @return string|null
     */
    public function getCompoundCode(): string
    {
        return $this->compoundCode;
    }

    /**
     * @param string|null $compoundCode
     */
    public function setCompoundCode(string $compoundCode)
    {
        $this->compoundCode = $compoundCode;
    }
}
