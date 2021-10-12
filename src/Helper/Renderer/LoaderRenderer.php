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
use Validaide\Common\JsonBuilder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LoaderRenderer extends AbstractJsonRenderer
{
//    const GOOGLE_URL = 'https://www.gstatic.com/charts/loader.js?callback=';
    const GOOGLE_URL = 'https://maps.googleapis.com/maps/api/js';

    /** @var string */
    private $language;

    /** @var string|null */
    private $key;

    /**
     * @param Formatter   $formatter
     * @param JsonBuilder $jsonBuilder
     * @param string      $language
     * @param null        $key
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
        return null !== $this->key;
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
    public function render($name, $callback, array $libraries = [], $newLine = true)
    {
        $formatter   = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        $jsonBuilder
            ->setValue('[callback]', $callback, false);

        return $formatter->renderClosure($formatter->renderCall($formatter->renderProperty('google', 'load'), [
            $formatter->renderEscape('current'),
            $jsonBuilder->build(),
        ]), [], $name, true, $newLine);
    }

    /**
     * @param       $callback
     * @param array $libraries
     *
     * @return string
     */
    public function renderSource($callback, array $libraries = [])
    {
        $queryParameters             = [];
        $queryParameters['key']      = $this->key;
        $queryParameters['language'] = $this->language;

        if (count($libraries) > 0) {
            $queryParameters['libraries'] = implode(',', $libraries);
        }

        $queryParameters['callback'] = $callback;

        return self::GOOGLE_URL . '?' . http_build_query($queryParameters);
    }
}
