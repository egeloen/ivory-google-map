<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

if (isset($_SERVER['RESET_CACHE']) && $_SERVER['RESET_CACHE']) {
    exec(sprintf('rm -rf %s/Service/.cache/*', __DIR__));
}

require_once __DIR__.'/../vendor/autoload.php';

\PHPUnit_Extensions_Selenium2TestCase::shareSession(true);
