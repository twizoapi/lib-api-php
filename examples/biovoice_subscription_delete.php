<?php
/**
 * Delete BioVoice subscription
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

use Twizo\Api\Entity;
use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

try {
    $bioVoiceSubscription = $twizo->getBioVoiceSubscription(readline('Number: '));

    EntityFormatter::dumpEntity($bioVoiceSubscription);
    print PHP_EOL;

    $bioVoiceSubscription->delete();

    print "Biovoice subscription deleted!" . PHP_EOL;
} catch (Entity\Exception $ex) {
    printf(
        "EntityException occurred: [%s] %s" . PHP_EOL,
        $ex->getStatusCode(),
        $ex->getMessage()
    );
}
