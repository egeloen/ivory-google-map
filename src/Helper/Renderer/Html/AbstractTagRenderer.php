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
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractTagRenderer extends AbstractRenderer
{
    private ?TagRenderer $tagRenderer = null;

    public function __construct(Formatter $formatter, TagRenderer $tagRenderer)
    {
        parent::__construct($formatter);

        $this->setTagRenderer($tagRenderer);
    }

    public function getTagRenderer(): TagRenderer
    {
        return $this->tagRenderer;
    }

    public function setTagRenderer(TagRenderer $tagRenderer)
    {
        $this->tagRenderer = $tagRenderer;
    }
}
