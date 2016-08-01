<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFunctionalTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->setBrowser(isset($_SERVER['BROWSER_NAME']) ? $_SERVER['BROWSER_NAME'] : 'chrome');
        $this->setBrowserUrl('file://'.sys_get_temp_dir());
    }

    /**
     * @param string|string[] $html
     */
    protected function renderHtml($html)
    {
        $name = tempnam(sys_get_temp_dir(), uniqid());
        $file = fopen($name, 'w+');
        fwrite($file, '<html><body>'.implode('', (array) $html).'</body></html>');
        fflush($file);

        $this->url(basename($name));

        unlink($name);
        fclose($file);
    }

    /**
     * @param string $variable
     */
    protected function assertVariableExists($variable)
    {
        $this->assertTrue($this->executeJavascript($script = 'typeof '.$variable.' !== typeof undefined'), $script);
    }

    /**
     * @param string        $expected
     * @param string        $variable
     * @param callable|null $formatter
     */
    protected function assertSameVariable($expected, $variable, $formatter = null)
    {
        $defaultFormatter = function ($expected, $variable) {
            return $expected.' === '.$variable;
        };

        $formatter = $formatter ?: $defaultFormatter;

        $this->assertTrue($this->executeJavascript($script = call_user_func(
            $formatter,
            $expected,
            $variable,
            $defaultFormatter
        )), $script);
    }

    /**
     * @param string  $script
     * @param mixed[] $args
     *
     * @return mixed
     */
    private function executeJavascript($script, array $args = [])
    {
        return $this->execute(['script' => 'return ('.$script.')', 'args' => $args]);
    }
}
