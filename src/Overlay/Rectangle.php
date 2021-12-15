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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\OptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Rectangle implements ExtendableInterface, OptionsAwareInterface
{
    use OptionsAwareTrait;
    use VariableAwareTrait;

    private ?Bound $bound = null;

    /**
     * @param mixed[] $options
     */
    public function __construct(Bound $bound, array $options = [])
    {
        $this->setBound($bound);
        $this->addOptions($options);
    }

    public function getBound(): Bound
    {
        return $this->bound;
    }

    public function setBound(Bound $bound): void
    {
        $this->bound = $bound;
    }
}
