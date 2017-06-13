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

$allowedTypes = array_map('trim', explode(',', readline('AllowedType(s) (Delimiter: ","): ')));
$recipient = null;
$backupCodeIdentifier = null;
if (in_array(WidgetSession::TYPE_SMS, $allowedTypes) || in_array(WidgetSession::TYPE_CALL, $allowedTypes)) {
    $recipient = readline('Number: ');
}

if (in_array(WidgetSession::TYPE_BACKUP_CODE, $allowedTypes)) {
    $backupCodeIdentifier = readline('BackupCodeIdentifier: ');
}

$widget = $twizo->createWidgetSession($allowedTypes, $recipient, $backupCodeIdentifier);
$widget->create();


EntityFormatter::dumpEntity($widget);
