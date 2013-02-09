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
    Ivory\GoogleMap\Overlays\GroundOverlay,
    Ivory\GoogleMap\Templating\Helper\Base\BoundHelper;

/**
 * Ground overlay helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\BoundHelper */
    protected $boundHelper;

    /**
     * Create a ground overlay helper.
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
     * Renders a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     * @param \Ivory\GoogleMap\Map                    $map           The map.
     *
     * @return string The JS output.
     */
    public function render(GroundOverlay $groundOverlay, Map $map)
    {
        $groundOverlayOptions = $groundOverlay->getOptions();
        $groundOverlayJSONOptions = sprintf('{"map":%s', $map->getJavascriptVariable());

        if (!empty($groundOverlayOptions)) {
            $groundOverlayJSONOptions .= ','.substr(json_encode($groundOverlayOptions), 1);
        } else {
            $groundOverlayJSONOptions .= '}';
        }

        $html = array();

        $html[] = $this->boundHelper->render($groundOverlay->getBound());
        $html[] = sprintf('var %s = new google.maps.GroundOverlay("%s", %s, %s);'.PHP_EOL,
            $groundOverlay->getJavascriptVariable(),
            $groundOverlay->getUrl(),
            $groundOverlay->getBound()->getJavascriptVariable(),
            $groundOverlayJSONOptions
        );

        return implode('', $html);
    }
}
