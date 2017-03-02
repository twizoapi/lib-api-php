<?php
/**
 * Send a concat sms to the api using the send simple function; the number is read from console and the message is automatically split into two parts by the api
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
$sms = $twizo->createSms(str_repeat('x', 200), readline('Number: '), 'testsender');
$sms->setResultType($sms::RESULT_TYPE_POLL);

$result = $sms->sendSimple();

foreach ($result as $sms) {
    EntityFormatter::dumpEntity($sms);
}
