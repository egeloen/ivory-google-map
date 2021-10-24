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

use PHPUnit\Extensions\Selenium2TestCase;
use RuntimeException;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFunctionalTest extends Selenium2TestCase
{
    /**
     * @var string
     */
    private static $directory;

    /**
     * @var bool
     */
    private static $hasDirectory;

    public static function setUpBeforeClass(): void
    {
        self::$directory = sys_get_temp_dir().'/ivory-google-map';
        self::$hasDirectory = is_dir(self::$directory);

        if (!self::$hasDirectory) {
            mkdir(self::$directory);
        }
    }

    public static function tearDownAfterClass(): void
    {
        if (!self::$hasDirectory) {
            rmdir(self::$directory);
        }
    }

    protected function setUp(): void
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
        if (($name = @tempnam(self::$directory, 'ivory-google-map')) === false) {
            throw new RuntimeException(sprintf('Unable to generate a unique file name in "%s".', self::$directory));
        }

        if (!is_resource($file = @fopen($name, 'w+'))) {
            throw new RuntimeException(sprintf('Unable to create the file "%s".', $name));
        }

        if (@fwrite($file, '<html><body>'.implode('', (array) $html).'</body></html>') === false) {
            throw new RuntimeException(sprintf('Unable to write in the file "%s".', $name));
        }

        if (@fflush($file) === false) {
            throw new RuntimeException(sprintf('Unable to flush the file "%s".', $name));
        }

        if (@fclose($file) === false) {
            throw new RuntimeException(sprintf('Unable to close the file "%s".', $name));
        }

        $this->url(basename($name));

        if (@unlink($name) === false) {
            throw new RuntimeException(sprintf('Unable to remove the file "%s".', $name));
        }
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
