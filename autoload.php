<?php
/**
 * Load the Twizo auto loader and register it
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once('src/AutoLoader.php');

$autoLoader = new \Twizo\Api\AutoLoader();
$autoLoader->register();
