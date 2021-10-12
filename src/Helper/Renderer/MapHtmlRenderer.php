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
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHtmlRenderer extends AbstractTagRenderer
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

    public function render(Map $map): string
    {
        $styles = [];
        $stylesheets = [
            'width'  => $map->hasStylesheetOption('width') ? $map->getStylesheetOption('width') : '300px',
            'height' => $map->hasStylesheetOption('height') ? $map->getStylesheetOption('height') : '300px',
        ];

        foreach ($stylesheets as $stylesheet => $value) {
            $styles[] = $this->stylesheetRenderer->render($stylesheet, $value);
        }

        return $this->getTagRenderer()->render('div', null, array_merge($map->getHtmlAttributes(), [
            'id'    => $map->getHtmlId(),
            'style' => implode('', $styles),
        ]));
    }
}
