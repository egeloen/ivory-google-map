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
use Ivory\GoogleMap\Utility\StaticOptionsAwareInterface;
use Ivory\GoogleMap\Utility\StaticOptionsAwareTrait;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolyline implements ExtendableInterface, OptionsAwareInterface, StaticOptionsAwareInterface
{
    use OptionsAwareTrait;
    use StaticOptionsAwareTrait;
    use VariableAwareTrait;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string  $value
     * @param mixed[] $options
     */
    public function __construct($value, array $options = [])
    {
        $this->setValue($value);
        $this->addOptions($options);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
