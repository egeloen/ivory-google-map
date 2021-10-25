<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Utility;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class VariableAwareTest extends TestCase
{
    /**
     * @var VariableAwareTrait
     */
    private $variableAware;

    protected function setUp(): void
    {
        $this->variableAware = new VariableAwareMock();
    }

    public function testDefaultState()
    {
        $this->assertIsString($this->variableAware->getVariable());
        $this->assertRegExp('/^variableawaremock[a-z0-9]*$/', $this->variableAware->getVariable());
    }

    public function testVariable()
    {
        $this->variableAware->setVariable($variable = 'foo');

        $this->assertSame($variable, $this->variableAware->getVariable());
    }
}

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class VariableAwareMock implements VariableAwareInterface
{
    use VariableAwareTrait;
}
