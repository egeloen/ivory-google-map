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

use Ivory\GoogleMap\Overlays\MarkerImage,
    Ivory\GoogleMap\Templating\Helper\Base\PointHelper,
    Ivory\GoogleMap\Templating\Helper\Base\SizeHelper;

/**
 * Marker image helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageHelper
{
    /** @var \Ivory\GoogleMap\Templating\Helper\Base\PointHelper */
    protected $pointHelper;

    /** @var \Ivory\GoogleMap\Templating\Helper\Base\SizeHelper */
    protected $sizeHelper;

    /**
     * Create a marker image helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\PointHelper $pointHelper The point helper.
     * @param \Ivory\GoogleMap\Templating\Helper\Base\SizeHelper  $sizeHelper  The size helper.
     */
    public function __construct(PointHelper $pointHelper = null, SizeHelper $sizeHelper = null)
    {
        if ($pointHelper === null) {
            $pointHelper = new PointHelper();
        }

        if ($sizeHelper === null) {
            $sizeHelper = new SizeHelper();
        }

        $this->setPointHelper($pointHelper);
        $this->setSizeHelper($sizeHelper);
    }

    /**
     * Gets the point helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\PointHelper The point helper.
     */
    public function getPointHelper()
    {
        return $this->pointHelper;
    }

    /**
     * Sets the point helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\PointHelper $pointHelper The point helper.
     */
    public function setPointHelper(PointHelper $pointHelper)
    {
        $this->pointHelper = $pointHelper;
    }

    /**
     * Gets the size helper.
     *
     * @return \Ivory\GoogleMap\Templating\Helper\Base\SizeHelper The size helper.
     */
    public function getSizeHelper()
    {
        return $this->sizeHelper;
    }

    /**
     * Sets the size helper.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\Base\SizeHelper $sizeHelper The size helper.
     */
    public function setSizeHelper(SizeHelper $sizeHelper)
    {
        $this->sizeHelper = $sizeHelper;
    }

    /**
     * Renders a marker image.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $markerImage The marker image.
     *
     * @return string The JS output.
     */
    public function render(MarkerImage $markerImage)
    {
        $html = array();

        $html[] = sprintf('var %s = new google.maps.MarkerImage("%s");'.PHP_EOL,
            $markerImage->getJavascriptVariable(),
            $markerImage->getUrl()
        );

        if ($markerImage->hasSize()) {
            $html[] = sprintf('%s.size = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->sizeHelper->render($markerImage->getSize())
            );
        }

        if ($markerImage->hasOrigin()) {
            $html[] = sprintf('%s.origin = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->pointHelper->render($markerImage->getOrigin())
            );
        }

        if ($markerImage->hasAnchor()) {
            $html[] = sprintf('%s.anchor = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->pointHelper->render($markerImage->getAnchor())
            );
        }

        if ($markerImage->hasScaledSize()) {
            $html[] = sprintf('%s.scaledSize = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->sizeHelper->render($markerImage->getScaledSize())
            );
        }

        return implode('', $html);
    }
}
