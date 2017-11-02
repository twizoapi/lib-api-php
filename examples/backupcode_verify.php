<?php
/**
 * Create backup codes; Use backup codes; Display result
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

print "[Create backup codes]" . PHP_EOL;
$backupCode = $twizo->createBackupCode(readline('Identifier: ' ));
$backupCode->create();

print PHP_EOL;
EntityFormatter::dumpEntity($backupCode);
print PHP_EOL;

print "[Verify backup code]" . PHP_EOL;
try {
    $backupCode->verify(readline('Code: '));
    EntityFormatter::dumpEntity($backupCode);

    print PHP_EOL . "Backup code verified!" . PHP_EOL;
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
