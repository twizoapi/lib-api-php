<?php
/**
 *  Create a widget register session; the number is read from console
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

use Twizo\Api\Entity\WidgetRegisterSession;
use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

$allowedTypes = null;
$allowedTypeInput = readline('AllowedType(s) (Delimiter: ",") (Allowed to leave empty): ');
if ("" !== $allowedTypeInput) {
    $allowedTypes = array_map('trim', explode(',', $allowedTypeInput));
}

$recipient = readline('Number (Allowed to leave empty): ');
if ("" === $recipient) {
    $recipient = null;
}

$backupCodeIdentifier = readline('BackupCode Identifier (Allowed to leave empty): ');
if ("" === $backupCodeIdentifier) {
    $backupCodeIdentifier = null;
}

$totpIdentifier = readline('TotpIdentifier (Allowed to leave empty): ');
if ("" === $totpIdentifier) {
    $totpIdentifier = null;
}

$issuer = readline('Issuer (Allowed to leave empty): ');
if ("" === $issuer) {
    $issuer = null;
}

$widget = $twizo->createWidgetRegisterSession($allowedTypes, $recipient, $backupCodeIdentifier, $totpIdentifier, $issuer);
$widget->create();

EntityFormatter::dumpEntity($widget);
