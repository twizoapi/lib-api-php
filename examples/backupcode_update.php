<?php
/**
 * Generate new codes for backup code; the identifier is read from console
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
use Twizo\Api\Entity\BackupCode;
use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

try {
    $identifier = readline('Identifier: ');
    $backupCode = $twizo->getBackupCode($identifier);
    $backupCode->setIdentifier($identifier);
    $backupCode->update();

    EntityFormatter::dumpEntity($backupCode);
} catch (BackupCode\Exception $ex) {
    printf(
        "BackupCode\\Exception occurred: [%s] %s" . PHP_EOL,
        $ex->getStatusCode(),
        $ex->getMessage()
    );
} catch (Entity\Exception $ex) {
    printf(
        "EntityException occurred: [%s] %s" . PHP_EOL,
        $ex->getStatusCode(),
        $ex->getMessage()
    );
}
