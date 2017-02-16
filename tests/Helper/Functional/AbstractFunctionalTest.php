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
     * @var string
     */
    private static $directory;

    /**
     * @var bool
     */
    private static $hasDirectory;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        self::$directory = sys_get_temp_dir().'/ivory-google-map';
        self::$hasDirectory = is_dir(self::$directory);

        if (!self::$hasDirectory) {
            mkdir(self::$directory);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tearDownAfterClass()
    {
        if (!self::$hasDirectory) {
            rmdir(self::$directory);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        if (isset($_SERVER['SELENIUM_HOST'])) {
            $this->setHost($_SERVER['SELENIUM_HOST']);
        }

        $this->setBrowser(isset($_SERVER['BROWSER_NAME']) ? $_SERVER['BROWSER_NAME'] : 'chrome');
        $this->setBrowserUrl('file://'.self::$directory);
    }

    /**
     * @param string|string[] $html
     */
    protected function renderHtml($html)
    {
        $name = tempnam(self::$directory, uniqid());
        $file = fopen($name, 'w+');
        fwrite($file, '<html><body>'.implode('', (array) $html).'</body></html>');
        fflush($file);

        $this->url(basename($name));

        fclose($file);
        unlink($name);
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
