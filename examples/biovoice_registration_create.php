<?php
/**
 * Register BioVoice
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
    $bioVoiceRegistration = $twizo->createBioVoiceRegistration(readline('Number: '));
    $bioVoiceRegistration->create();

    EntityFormatter::dumpEntity($bioVoiceRegistration);
} catch (Entity\Exception $ex) {
    printf(
        "EntityException occurred: [%s] %s" . PHP_EOL,
        $ex->getStatusCode(),
        $ex->getMessage()
    );
}
