<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helpers\Factories;

use Ivory\GoogleMap\Helpers\Factories\DependencyInjection\IvoryGoogleMapExtension;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ResolveParameterPlaceHoldersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;

/**
 * Symfony 2 helper factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Symfony2HelperFactory extends AbstractHelperFactory
{
    /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
    private $container;

    /** @var string|null */
    private $cachePath;

    /** @var string */
    private $containerName;

    /** @var array */
    private $parameters;

    /** @var array */
    private $extensions;

    /** @var array */
    private $compilerPasses;

    /**
     * Creates a Symfony 2 helper factory.
     *
     * @param boolean     $debug          The debug.
     * @param integer     $indentation    The indentation.
     * @param string|null $cachePath      The cache path.
     * @param string      $containerName  The container name.
     * @param array       $parameters     The parameters.
     * @param array       $extensions     The extensions.
     * @param array       $compilerPasses The compiler passes.
     */
    public function __construct(
        $debug = false,
        $indentation = 4,
        $cachePath = null,
        $containerName = 'IvoryGoogleMapContainer',
        array $parameters = array(),
        array $extensions = array(),
        array $compilerPasses = array()
    ) {
        parent::__construct($debug, $indentation);

        $this->setCachePath($cachePath);
        $this->setContainerName($containerName);
        $this->setParameters($parameters);
        $this->setExtensions($extensions);
        $this->setCompilerPasses($compilerPasses);
    }

    /**
     * {@inheritdoc}
     */
    public function setDebug($debug)
    {
        parent::setDebug($debug);

        $this->container = null;
        $this->setParameter('ivory.google_map.debug', $debug);
    }

    /**
     * {@inheritdoc}
     */
    public function setIndentation($indentation)
    {
        parent::setIndentation($indentation);

        $this->container = null;
        $this->setParameter('ivory.google_map.indentation', $indentation);
    }

    /**
     * Checks if there is a cache path.
     *
     * @return boolean TRUE if there is a cache path else FALSE.
     */
    public function hasCachePath()
    {
        return $this->cachePath !== null;
    }

    /**
     * Gets the cache path.
     *
     * @return string|null The cache path.
     */
    public function getCachePath()
    {
        return $this->cachePath;
    }

    /**
     * Sets the cache path.
     *
     * @param string|null $cachePath The cache path.
     */
    public function setCachePath($cachePath)
    {
        $this->container = null;
        $this->cachePath = $cachePath;
    }

    /**
     * Gets the container name.
     *
     * @return string The container name.
     */
    public function getContainerName()
    {
        return $this->containerName;
    }

    /**
     * Sets the container name.
    *
     * @param string $containerName The container name.
     */
    public function setContainerName($containerName)
    {
        $this->container = null;
        $this->containerName = $containerName;
    }

    /**
     * Resets the parameters.
     */
    public function resetParameters()
    {
        $this->container = null;
        $this->parameters = array(
            'ivory.google_map.debug'       => $this->isDebug(),
            'ivory.google_map.indentation' => $this->getIndentation(),
        );
    }

    /**
     * Checks if there are parameters.
     *
     * @return boolean TRUE if there are parameters else FALSE.
     */
    public function hasParameters()
    {
        return !empty($this->parameters);
    }

    /**
     * Gets the parameters.
     *
     * @return array The parameters.
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Sets the parameters.
     *
     * @param array $parameters The parameters.
     */
    public function setParameters(array $parameters)
    {
        $this->resetParameters();
        $this->addParameters($parameters);
    }

    /**
     * Adds the parameters.
     *
     * @param array $parameters The parameters.
     */
    public function addParameters(array $parameters)
    {
        foreach ($parameters as $name => $value) {
            $this->setParameter($name, $value);
        }
    }

    /**
     * Removes the parameters.
     *
     * @param array $names The names.
     */
    public function removeParameters(array $names)
    {
        foreach ($names as $name) {
            $this->removeParameter($name);
        }
    }

    /**
     * Checks if there is a parameter.
     *
     * @param string $name The name.
     *
     * @return boolean TRUE if there is a parameter else FALSE.
     */
    public function hasParameter($name)
    {
        return isset($this->parameters[$name]);
    }

    /**
     * Gets a parameter.
     *
     * @param string $name The name.
     *
     * @return mixed|null The parameter.
     */
    public function getParameter($name)
    {
        return $this->hasParameter($name) ? $this->parameters[$name] : null;
    }

    /**
     * Sets a parameter.
     *
     * @param string $name  The name.
     * @param mixed  $value The value.
     */
    public function setParameter($name, $value)
    {
        $this->container = null;
        $this->parameters[$name] = $value;
    }

    /**
     * Removes a parameter.
     *
     * @param string $name The name.
     */
    public function removeParameter($name)
    {
        if (!in_array($name, array('ivory.google_map.debug', 'ivory.google_map.indentation'), true)) {
            $this->container = null;
            unset($this->parameters[$name]);
        }
    }

    /**
     * Resets the extensions.
     */
    public function resetExtensions()
    {
        $this->container = null;
        $this->extensions = array(new IvoryGoogleMapExtension());
    }

    /**
     * Checks if there are extensions.
     *
     * @return boolean TRUE if there are extensions else FALSE.
     */
    public function hasExtensions()
    {
        return !empty($this->extensions);
    }

    /**
     * Gets the extensions.
     *
     * @return array The extensions.
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Sets the extension.
     *
     * @param array $extensions The extensions.
     */
    public function setExtensions(array $extensions)
    {
        $this->resetExtensions();
        $this->addExtensions($extensions);
    }

    /**
     * Adds the extensions.
     *
     * @param array $extensions The extensions.
     */
    public function addExtensions(array $extensions)
    {
        foreach ($extensions as $extension) {
            $this->addExtension($extension);
        }
    }

    /**
     * Removes the extensions.
     *
     * @param array $extensions The extensions.
     */
    public function removeExtensions(array $extensions)
    {
        foreach ($extensions as $extension) {
            $this->removeExtension($extension);
        }
    }

    /**
     * Checks if there is an extension.
     *
     * @param \Symfony\Component\DependencyInjection\Extension\ExtensionInterface $extension The extension.
     *
     * @return boolean TRUE if there is the extension else FALSE.
     */
    public function hasExtension(ExtensionInterface $extension)
    {
        return in_array($extension, $this->extensions, true);
    }

    /**
     * Adds an extension.
     *
     * @param \Symfony\Component\DependencyInjection\Extension\ExtensionInterface $extension The extension.
     */
    public function addExtension(ExtensionInterface $extension)
    {
        $this->container = null;

        if (!$this->hasExtension($extension)) {
            $this->extensions[] = $extension;
        }
    }

    /**
     * Removes an extension.
     *
     * @param \Symfony\Component\DependencyInjection\Extension\ExtensionInterface $extension The extension.
     */
    public function removeExtension(ExtensionInterface $extension)
    {
        $this->container = null;
        unset($this->extensions[array_search($extension, $this->extensions, true)]);
    }

    /**
     * Resets the compiler passes.
     */
    public function resetCompilerPasses()
    {
        $this->container = null;
        $this->compilerPasses = array(
            new ResolveParameterPlaceHoldersPass(),
            new RegisterListenersPass(
                'ivory.google_map.helpers.event_dispatcher',
                'ivory.google_map.helpers.listener',
                'ivory.google_map.helpers.subscriber'
            ),
        );
    }

    /**
     * Checks if there are compiler passes.
     *
     * @return boolean TRUE if there are compiler passes else FALSE.
     */
    public function hasCompilerPasses()
    {
        return !empty($this->compilerPasses);
    }

    /**
     * Gets the compiler passes.
     *
     * @return array The compiler passes.
     */
    public function getCompilerPasses()
    {
        return $this->compilerPasses;
    }

    /**
     * Sets the compiler passes.
     *
     * @param array $compilerPasses The compiler passes.
     */
    public function setCompilerPasses(array $compilerPasses)
    {
        $this->resetCompilerPasses();
        $this->addCompilerPasses($compilerPasses);
    }

    /**
     * Adds the compiler passes.
     *
     * @param array $compilerPasses The compiler passes.
     */
    public function addCompilerPasses(array $compilerPasses)
    {
        foreach ($compilerPasses as $compilerPass) {
            $this->addCompilerPass($compilerPass);
        }
    }

    /**
     * Removes the compiler passes.
     *
     * @param array $compilerPasses The compiler passes.
     */
    public function removeCompilerPasses(array $compilerPasses)
    {
        foreach ($compilerPasses as $compilerPass) {
            $this->removeCompilerPass($compilerPass);
        }
    }

    /**
     * Checks if there is a compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface $compilerPass The compiler pass.
     *
     * @return boolean TRUE if there is a compiler pass else FALSE.
     */
    public function hasCompilerPass(CompilerPassInterface $compilerPass)
    {
        return in_array($compilerPass, $this->compilerPasses, true);
    }

    /**
     * Adds a compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface $compilerPass The compiler pass.
     */
    public function addCompilerPass(CompilerPassInterface $compilerPass)
    {
        $this->container = null;

        if (!in_array($compilerPass, $this->compilerPasses)) {
            $this->compilerPasses[] = $compilerPass;
        }
    }

    /**
     * Removes a compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface $compilerPass The compiler pass.
     */
    public function removeCompilerPass(CompilerPassInterface $compilerPass)
    {
        $this->container = null;
        unset($this->compilerPasses[array_search($compilerPass, $this->compilerPasses, true)]);
    }

    /**
     * {@inheritdoc}
     */
    public function createApiHelper()
    {
        return $this->getContainer()->get('ivory.google_map.helpers.api');
    }

    /**
     * {@inheritdoc}
     */
    public function createMapHelper()
    {
        return $this->getContainer()->get('ivory.google_map.helpers.map');
    }

    /**
     * {@inheritdoc}
     */
    public function createPlacesAutocompleteHelper()
    {
        return $this->getContainer()->get('ivory.google_map.helpers.places.autocomplete');
    }

    /**
     * Gets the container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface The container.
     */
    private function getContainer()
    {
        if ($this->container === null) {
            $this->container = $this->createContainer();
        }

        return $this->container;
    }

    /**
     * Creates the container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface The container.
     */
    private function createContainer()
    {
        if (!$this->hasCachePath()) {
            return $this->buildContainer();
        }

        $config = new ConfigCache($containerPath = $this->cachePath.'/'.$this->containerName.'.php', $this->isDebug());

        if (!$config->isFresh()) {
            $dumper = new PhpDumper($containerBuilder = $this->buildContainer());
            $config->write($dumper->dump(array('class' => $this->containerName)), $containerBuilder->getResources());
        }

        require_once $containerPath;

        return new $this->containerName();
    }

    /**
     * Builds the container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder The container.
     */
    private function buildContainer()
    {
        $containerBuilder = new ContainerBuilder();

        foreach ($this->parameters as $name => $value) {
            $containerBuilder->setParameter($name, $value);
        }

        foreach ($this->extensions as $extension) {
            $containerBuilder->registerExtension($extension);
            $containerBuilder->loadFromExtension($extension->getAlias());
        }

        foreach ($this->compilerPasses as $compilerPass) {
            $containerBuilder->addCompilerPass($compilerPass);
        }

        $containerBuilder->compile();

        return $containerBuilder;
    }
}
