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
    private ?StylesheetRenderer $stylesheetRenderer = null;

    public function __construct(Formatter $formatter, TagRenderer $tagRenderer, StylesheetRenderer $stylesheetRenderer)
    {
        parent::__construct($formatter, $tagRenderer);

        $this->setStylesheetRenderer($stylesheetRenderer);
    }

    public function getStylesheetRenderer(): StylesheetRenderer
    {
        return $this->stylesheetRenderer;
    }

    public function setStylesheetRenderer(StylesheetRenderer $stylesheetRenderer): void
    {
        $this->stylesheetRenderer = $stylesheetRenderer;
    }

    /**
     * @param string   $name
     * @param string[] $stylesheets
     * @param string[] $attributes
     * @param bool     $newLine
     */
    public function render($name, array $stylesheets, array $attributes = [], $newLine = true): string
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
