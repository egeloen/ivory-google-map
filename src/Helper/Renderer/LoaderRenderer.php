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
use Ivory\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LoaderRenderer extends AbstractJsonRenderer
{
    /**
     * @var string
     */
    private $language;

    /**
     * @var string|null
     */
    private $key;

    /**
     * @param Formatter   $formatter
     * @param JsonBuilder $jsonBuilder
     * @param string      $language
     * @param string|null $key
     */
    public function __construct(Formatter $formatter, JsonBuilder $jsonBuilder, $language = 'en', $key = null)
    {
        parent::__construct($formatter, $jsonBuilder);

        $this->setLanguage($language);
        $this->setKey($key);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return bool
     */
    public function hasKey()
    {
        return $this->key !== null;
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param string   $name
     * @param string   $callback
     * @param string[] $libraries
     * @param bool     $newLine
     *
     * @return string
     */
    public function render(
        $name,
        $callback,
        array $libraries = [],
        $newLine = true
    ) {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        $parameters = ['language' => $this->language];

        if ($this->hasKey()) {
            $parameters['key'] = $this->key;
        }

        if (!empty($libraries)) {
            $parameters['libraries'] = implode(',', $libraries);
        }

        $jsonBuilder
            ->setValue('[other_params]', urldecode(http_build_query($parameters, '', '&')))
            ->setValue('[callback]', $callback, false);

        return $formatter->renderClosure($formatter->renderCall($formatter->renderProperty('google', 'load'), [
            $formatter->renderEscape('maps'),
            $formatter->renderEscape('3'),
            $jsonBuilder->build(),
        ]), [], $name, true, $newLine);
    }

    /**
     * @param string $callback
     *
     * @return string
     */
    public function renderSource($callback)
    {
        return 'https://www.google.com/jsapi?callback='.$callback;
    }
}
