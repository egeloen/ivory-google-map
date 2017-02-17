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

use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference#IconSequence
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconSequence implements OptionsAwareInterface, VariableAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var Symbol
     */
    private $symbol;

    /**
     * @param Symbol  $symbol
     * @param mixed[] $options
     */
    public function __construct(Symbol $symbol, array $options = [])
    {
        $this->setSymbol($symbol);
        $this->setOptions($options);
    }

    /**
     * @return Symbol
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param Symbol $symbol
     */
    public function setSymbol(Symbol $symbol)
    {
        $this->symbol = $symbol;
    }
}
