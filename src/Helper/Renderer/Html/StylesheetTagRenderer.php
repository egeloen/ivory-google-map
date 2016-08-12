<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StylesheetTagRenderer extends AbstractTagRenderer
{
    /**
     * @var StylesheetRenderer
     */
    private $stylesheetRenderer;

    /**
     * @param Formatter          $formatter
     * @param TagRenderer        $tagRenderer
     * @param StylesheetRenderer $stylesheetRenderer
     */
    public function __construct(Formatter $formatter, TagRenderer $tagRenderer, StylesheetRenderer $stylesheetRenderer)
    {
        parent::__construct($formatter, $tagRenderer);

        $this->setStylesheetRenderer($stylesheetRenderer);
    }

    /**
     * @return StylesheetRenderer
     */
    public function getStylesheetRenderer()
    {
        return $this->stylesheetRenderer;
    }

    /**
     * @param StylesheetRenderer $stylesheetRenderer
     */
    public function setStylesheetRenderer(StylesheetRenderer $stylesheetRenderer)
    {
        $this->stylesheetRenderer = $stylesheetRenderer;
    }

    /**
     * @param string   $name
     * @param string[] $stylesheets
     * @param string[] $attributes
     * @param bool     $newLine
     *
     * @return string
     */
    public function render($name, array $stylesheets, array $attributes = [], $newLine = true)
    {
        $formatter = $this->getFormatter();

        $tagStylesheets = [];
        foreach ($stylesheets as $stylesheet => $value) {
            $tagStylesheets[] = $this->stylesheetRenderer->render($stylesheet, $value);
        }

        return $this->getTagRenderer()->render(
            'style',
            $formatter->renderLines([
                $name.$formatter->renderSeparator().'{',
                $formatter->renderIndentation($formatter->renderLines($tagStylesheets, true, false)),
                '}',
            ], !empty($tagStylesheets), false),
            array_merge(['type' => 'test/css'], $attributes),
            $newLine
        );
    }
}
