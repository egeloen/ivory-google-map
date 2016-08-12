<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementLoaderRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\SourceRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiRenderer extends AbstractRenderer
{
    /**
     * @var ApiInitRenderer
     */
    private $apiInitRenderer;

    /**
     * @var LoaderRenderer
     */
    private $loaderRenderer;

    /**
     * @var RequirementLoaderRenderer
     */
    private $requirementLoaderRenderer;

    /**
     * @var SourceRenderer
     */
    private $sourceRenderer;

    /**
     * @param Formatter                 $formatter
     * @param ApiInitRenderer           $apiInitRenderer
     * @param LoaderRenderer            $loaderRenderer
     * @param RequirementLoaderRenderer $requirementLoaderRenderer
     * @param SourceRenderer            $sourceRenderer
     */
    public function __construct(
        Formatter $formatter,
        ApiInitRenderer $apiInitRenderer,
        LoaderRenderer $loaderRenderer,
        RequirementLoaderRenderer $requirementLoaderRenderer,
        SourceRenderer $sourceRenderer
    ) {
        parent::__construct($formatter);

        $this->setApiInitRenderer($apiInitRenderer);
        $this->setLoaderRenderer($loaderRenderer);
        $this->setRequirementLoaderRenderer($requirementLoaderRenderer);
        $this->setSourceRenderer($sourceRenderer);
    }

    /**
     * @return ApiInitRenderer
     */
    public function getApiInitRenderer()
    {
        return $this->apiInitRenderer;
    }

    /**
     * @param ApiInitRenderer $apiInitRenderer
     */
    public function setApiInitRenderer(ApiInitRenderer $apiInitRenderer)
    {
        $this->apiInitRenderer = $apiInitRenderer;
    }

    /**
     * @return LoaderRenderer
     */
    public function getLoaderRenderer()
    {
        return $this->loaderRenderer;
    }

    /**
     * @param LoaderRenderer $loaderRenderer
     */
    public function setLoaderRenderer(LoaderRenderer $loaderRenderer)
    {
        $this->loaderRenderer = $loaderRenderer;
    }

    /**
     * @return RequirementLoaderRenderer
     */
    public function getRequirementLoaderRenderer()
    {
        return $this->requirementLoaderRenderer;
    }

    /**
     * @param RequirementLoaderRenderer $requirementLoaderRenderer
     */
    public function setRequirementLoaderRenderer(RequirementLoaderRenderer $requirementLoaderRenderer)
    {
        $this->requirementLoaderRenderer = $requirementLoaderRenderer;
    }

    /**
     * @return SourceRenderer
     */
    public function getSourceRenderer()
    {
        return $this->sourceRenderer;
    }

    /**
     * @param SourceRenderer $sourceRenderer
     */
    public function setSourceRenderer(SourceRenderer $sourceRenderer)
    {
        $this->sourceRenderer = $sourceRenderer;
    }

    /**
     * @param \SplObjectStorage $callbacks
     * @param \SplObjectStorage $requirements
     * @param string[]          $sources
     * @param string[]          $libraries
     *
     * @return string
     */
    public function render(
        \SplObjectStorage $callbacks,
        \SplObjectStorage $requirements,
        array $sources = [],
        array $libraries = []
    ) {
        $formatter = $this->getFormatter();

        $loadCallback = $this->getCallbackName('load');
        $initCallback = $this->getCallbackName('init');
        $initSourceCallback = $this->getCallbackName('init_source');
        $initRequirementCallback = $this->getCallbackName('init_requirement');

        return $formatter->renderLines([
            $this->loaderRenderer->render($loadCallback, $initCallback, $libraries, false),
            $this->sourceRenderer->render($initSourceCallback, null, null, false),
            $this->requirementLoaderRenderer->render($initRequirementCallback, null, null, null, 100, false),
            $this->apiInitRenderer->render(
                $initCallback,
                $callbacks,
                $requirements,
                $sources,
                $initSourceCallback,
                $initRequirementCallback,
                false
            ),
            $formatter->renderCall($initSourceCallback, [
                $formatter->renderEscape($this->loaderRenderer->renderSource($loadCallback)),
            ], true),
        ], true, false);
    }

    /**
     * @param string $callback
     *
     * @return string
     */
    private function getCallbackName($callback)
    {
        return 'ivory_google_map_'.$callback;
    }
}
