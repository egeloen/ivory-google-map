<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helpers\Factories;

use Ivory\GoogleMap\Helpers\Factories\Symfony2HelperFactory;

/**
 * Symfony 2 helper factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Symfony2HelperFactoryTest extends AbstractHelperFactoryTest
{
    /** @var string */
    private $cachePath;

    /**
     * {@inheritdo©}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->cachePath = realpath(sys_get_temp_dir());
    }

    /**
     * {@inheritdo©}
     */
    protected function tearDown()
    {
        if ($this->helperFactory->hasCachePath()) {
            $filename = $this->helperFactory->getCachePath().'/'.$this->helperFactory->getContainerName().'.php';

            if (file_exists($filename)) {
                unlink($filename);
            }
        }

        parent::tearDown();

        unset($this->cachePath);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->helperFactory->isDebug());
        $this->assertSame(4, $this->helperFactory->getIndentation());
        $this->assertFalse($this->helperFactory->hasCachePath());
        $this->assertSame('IvoryGoogleMapContainer', $this->helperFactory->getContainerName());
        $this->assertParameters();
        $this->assertExtensions();
    }

    public function testInitialState()
    {
        $this->helperFactory = new Symfony2HelperFactory(
            true,
            $indentation = 2,
            $this->cachePath,
            $containerName = 'foo'
        );

        $this->assertTrue($this->helperFactory->isDebug());
        $this->assertSame($indentation, $this->helperFactory->getIndentation());
        $this->assertTrue($this->helperFactory->hasCachePath());
        $this->assertSame($this->cachePath, $this->helperFactory->getCachePath());
        $this->assertSame($containerName, $this->helperFactory->getContainerName());
    }

    public function testSetCachePath()
    {
        $this->helperFactory->setCachePath($cachePath = $this->cachePath);

        $this->assertTrue($this->helperFactory->hasCachePath());
        $this->assertSame($cachePath, $this->helperFactory->getCachePath());
    }

    public function testSetContainerName()
    {
        $this->helperFactory->setContainerName($containerName = 'foo');

        $this->assertSame($containerName, $this->helperFactory->getContainerName());
    }

    public function testSetParameters()
    {
        $this->helperFactory->setParameters($parameters = array(
            'ivory.google_map.debug'       => true,
            'ivory.google_map.indentation' => 2,
            'foo'                          => 'bar',
        ));

        $this->assertParameters($parameters);
    }

    public function testAddParameters()
    {
        $this->helperFactory->addParameters($parameters = array(
            'ivory.google_map.debug'       => true,
            'ivory.google_map.indentation' => 2,
            'foo'                          => 'bar',
        ));

        $this->assertParameters($parameters);
    }

    public function testRemoveParameters()
    {
        $this->helperFactory->setParameters($parameters = array(
            'ivory.google_map.debug'       => false,
            'ivory.google_map.indentation' => 4,
            'foo'                          => 'bar',
        ));

        $this->helperFactory->removeParameters(array_keys($parameters));

        $this->assertParameters();
    }

    public function testSetParameter()
    {
        $this->helperFactory->setParameter($name = 'foo', $value = 'bar');

        $this->assertParameter($name, $value);
    }

    public function testRemoveParameter()
    {
        $this->helperFactory->setParameter($name = 'foo', 'bar');
        $this->helperFactory->removeParameter($name);

        $this->assertNoParameter($name);
    }

    public function testSetExtensions()
    {
        $this->helperFactory->setExtensions(
            $extensions = array($this->createSymfonyExtensionMock())
        );

        $this->assertExtensions($extensions);
    }

    public function testAddExtensions()
    {
        $this->helperFactory->addExtensions(
            $extensions = array($this->createSymfonyExtensionMock())
        );

        $this->assertExtensions($extensions);
    }

    public function testRemoveExtensions()
    {
        $this->helperFactory->setExtensions(
            $extensions = array($this->createSymfonyExtensionMock())
        );

        $this->helperFactory->removeExtensions($extensions);

        $this->assertExtensions();
    }

    public function testAddExtension()
    {
        $this->helperFactory->addExtension($extension = $this->createSymfonyExtensionMock());

        $this->assertExtensions(array($extension));
    }

    public function testRemoveExtension()
    {
        $this->helperFactory->addExtension($extension = $this->createSymfonyExtensionMock());
        $this->helperFactory->removeExtension($extension);

        $this->assertNoExtension($extension);
    }

    public function testSetCompilerPasses()
    {
        $this->helperFactory->setCompilerPasses(
            $compilerPasses = array($this->createSymfonyCompilerPassMock())
        );

        $this->assertCompilerPasses($compilerPasses);
    }

    public function testAddCompilerPasses()
    {
        $this->helperFactory->addCompilerPasses(
            $compilerPasses = array($this->createSymfonyCompilerPassMock())
        );

        $this->assertCompilerPasses($compilerPasses);
    }

    public function testRemoveCompilerPasses()
    {
        $this->helperFactory->setCompilerPasses(
            $compilerPasses = array($this->createSymfonyCompilerPassMock())
        );

        $this->helperFactory->removeCompilerPasses($compilerPasses);

        $this->assertCompilerPasses();
    }

    public function testAddCompilerPass()
    {
        $this->helperFactory->addCompilerPass(
            $compilerPass = $this->createSymfonyCompilerPassMock()
        );

        $this->assertCompilerPasses(array($compilerPass));
    }

    public function testRemoveCompilerPass()
    {
        $this->helperFactory->addCompilerPass(
            $compilerPass = $this->createSymfonyCompilerPassMock()
        );

        $this->helperFactory->removeCompilerPass($compilerPass);

        $this->assertNoCompilerPass($compilerPass);
    }

    public function testContainerCache()
    {
        $this->helperFactory->setCachePath($this->cachePath);

        $this->assertApiHelperInstance($this->helperFactory->createApiHelper());
        $this->assertMapHelperInstance($this->helperFactory->createMapHelper());
        $this->assertAutocompleteHelperInstance($this->helperFactory->createPlacesAutocompleteHelper());

        $this->assertFileExists(
            $this->helperFactory->getCachePath().'/'.$this->helperFactory->getContainerName().'.php'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function createHelperFactory()
    {
        return new Symfony2HelperFactory();
    }

    /**
     * Asserts the parameters.
     *
     * @param array $parameters The parameters.
     */
    private function assertParameters(array $parameters = array())
    {
        $parameters = array_merge(
            array(
                'ivory.google_map.debug'       => false,
                'ivory.google_map.indentation' => 4,
            ),
            $parameters
        );

        $this->assertTrue($this->helperFactory->hasParameters());
        $this->assertSame($parameters, $this->helperFactory->getParameters());

        foreach ($parameters as $name => $value) {
            $this->assertParameter($name, $value);
        }
    }

    /**
     * Asserts a parameters.
     *
     * @param string $name  The name.
     * @param mixed  $value The value.
     */
    private function assertParameter($name, $value)
    {
        $this->assertTrue($this->helperFactory->hasParameter($name));
        $this->assertSame($value, $this->helperFactory->getParameter($name));
    }

    /**
     * Asserts no parameter.
     *
     * @param string $name The name.
     */
    private function assertNoParameter($name)
    {
        $this->assertFalse($this->helperFactory->hasParameter($name));
        $this->assertNull($this->helperFactory->getParameter($name));
    }

    /**
     * Asserts the extensions.
     *
     * @param array $extensions The extensions.
     */
    private function assertExtensions(array $extensions = array())
    {
        $this->assertTrue($this->helperFactory->hasExtensions());
        $this->assertSame(count($extensions) + 1, count($this->helperFactory->getExtensions()));

        foreach ($extensions as $extension) {
            $this->assertSymfonyExtensionInstance($extension);
            $this->assertTrue($this->helperFactory->hasExtension($extension));
        }
    }

    /**
     * Asserts no extension.
     *
     * @param \Symfony\Component\DependencyInjection\Extension\ExtensionInterface $extension The extension.
     */
    private function assertNoExtension($extension)
    {
        $this->assertSymfonyExtensionInstance($extension);
        $this->assertFalse($this->helperFactory->hasExtension($extension));
    }

    /**
     * Asserts the compiler passes.
     *
     * @param array $compilerPasses The compiler passes.
     */
    private function assertCompilerPasses(array $compilerPasses = array())
    {
        $this->assertTrue($this->helperFactory->hasCompilerPasses());
        $this->assertSame(count($compilerPasses) + 2, count($this->helperFactory->getCompilerPasses()));

        foreach ($compilerPasses as $compilerPass) {
            $this->assertSymfonyCompilerPassInstance($compilerPass);
            $this->assertTrue($this->helperFactory->hasCompilerPass($compilerPass));
        }
    }

    /**
     * Asserts no compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface $compilerPass The compiler pass.
     */
    private function assertNoCompilerPass($compilerPass)
    {
        $this->assertSymfonyCompilerPassInstance($compilerPass);
        $this->assertFalse($this->helperFactory->hasCompilerPass($compilerPass));
    }
}
