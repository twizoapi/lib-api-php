<?php
/**
 *  Create a widget session; the number is read from console
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

use Twizo\Api\Entity\WidgetSession;
use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

$widget = $twizo->createWidgetSession(readline('Number: ' ));
$widget->create();


EntityFormatter::dumpEntity($widget);
