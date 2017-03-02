<?php
/**
 * Retrieve number lookup polling results; works only when result type is set to polling
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);
$numberLookupResults = $twizo->getNumberLookupResults();

if (count($numberLookupResults) == 0) {
    print 'No number lookup results found' . PHP_EOL;
}

foreach ($numberLookupResults as $numberLookup) {
    EntityFormatter::dumpEntity($numberLookup);
}
