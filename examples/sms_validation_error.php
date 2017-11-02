<?php
/**
 * Send a sms to the api and catch validation errors
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);
// Set invalid recipients and invalid sender
$sms = $twizo->createSms('test_message', array('123', 'testtest'), '!!!');
$sms->setResultType($sms::RESULT_TYPE_POLL);

try {
    $sms->send();
} catch (Twizo\Api\Entity\Validation\Exception $e) {
    foreach ($e->getErrorFields() as $errorField) {
        if ($errorField->getArrayIndex() === null) {
            printf(
                'Field "%s" with "value" %s returned message "%s" (%s)' . PHP_EOL,
                $errorField->getName(),
                $errorField->getValue(),
                $errorField->getMessage(),
                $errorField->getType()
            );
        } else {
            printf(
                'Field "%s" (array index: %d) with value "%s" returned message "%s" (%s)' . PHP_EOL,
                $errorField->getName(),
                $errorField->getArrayIndex(),
                $errorField->getValue(),
                $errorField->getMessage(),
                $errorField->getType()
            );
        }
    }
} catch (Twizo\Api\Entity\Exception $e) {
    print 'Exception occurred while sending request to server: ' . $e->getMessage() . PHP_EOL;
}
