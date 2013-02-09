<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Templating\Helper\Overlays;

use Ivory\GoogleMap\Map,
    Ivory\GoogleMap\Overlays\Rectangle,
    Ivory\GoogleMap\Templating\Helper\Base\BoundHelper;

/**
 * Rectangle helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper */
    protected $boundHelper;

    /**
     * Creates a rectangle helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper $boundHelper The bound helper.
     */
    public function __construct(BoundHelper $boundHelper = null)
    {
        if ($boundHelper === null) {
            $boundHelper = new BoundHelper();
        }

        $this->setBoundHelper($boundHelper);
    }

    /**
     * Gets the bound helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper The bound helper.
     */
    public function getBoundHelper()
    {
        return $this->boundHelper;
    }

    /**
     * Sets the bound helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper $boundHelper The bound helper.
     */
    public function setBoundHelper(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Renders a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     * @param \Ivory\GoogleMap\Map                $map       The map.
     *
     * @return string The JS output.
     */
    public function render(Rectangle $rectangle, Map $map)
    {
        $rectangleOptions = $rectangle->getOptions();

        $rectangleJSONOptions = sprintf('{"map":%s,"bounds":%s',
            $map->getJavascriptVariable(),
            $rectangle->getBound()->getJavascriptVariable()
        );

        if (!empty($rectangleOptions)) {
            $rectangleJSONOptions .= ','.substr(json_encode($rectangleOptions), 1);
        } else {
            $rectangleJSONOptions .= '}';
        }

        $html = array();

        $html[] = $this->boundHelper->render($rectangle->getBound());
        $html[] = sprintf('var %s = new google.maps.Rectangle(%s);'.PHP_EOL,
            $rectangle->getJavascriptVariable(),
            $rectangleJSONOptions
        );

        return implode('', $html);
    }
}
