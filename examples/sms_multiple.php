<?php
/**
 * Send a sms to the multiple numbers; the numbers are read from console
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
$sms = $twizo->createSms('test_message', array(readline('Number 1: '), readline('Number 2: ')), 'testsender');
$sms->setResultType($sms::RESULT_TYPE_POLL);

$result = $sms->send();

foreach ($result as $sms) {
    EntityFormatter::dumpEntity($sms);
}
