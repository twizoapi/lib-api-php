<?php

namespace Twizo\Api\Entity\Validation;

/**
 * Define an error field for use in validation exceptions
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class ErrorField
{
    const TYPE_ARRAY_TOO_BIG = 'arrayTooBig'; // When supplied array is too large
    const TYPE_BINARY_NO_HEX = 'noHexEncoding'; // When a binary message has been send without hex encoding
    const TYPE_BODY_TOO_LONG = 'bodyTooLong'; // When the body field is too long
    const TYPE_CALLBACK_URL_SET = 'callbackUrlSet'; // Callback url has been set when no callback is requested
    const TYPE_FIELD_NOT_SET = 'fieldNotSet'; // Required field when the current field is set
    const TYPE_FIELD_SET = 'fieldSet'; // Field should not be set for the current type
    const TYPE_INVALID   = 'stringLengthInvalid'; // Invalid string data in field
    const TYPE_INVALID_CHARACTER = 'invalidCharacter'; // Invalid character(s) found
    const TYPE_INVALID_DIGITS = 'digitsInvalid'; // Invalid digits in field
    const TYPE_INVALID_GSM = 'invalidGsm'; // Invalid gsm character found in body
    const TYPE_INVALID_HEX = 'hexInvalid'; // Field should contain a hex encoded string
    const TYPE_INVALID_URL = 'uriInvalid'; // Field should contain a string with an URL
    const TYPE_INVALID_UTF8 = 'invalidUtf8'; // Invalid utf-8 character found in body
    const TYPE_NO_ARRAY_SUPPLIED = 'noArraySupplied'; // No array found in field which requires this
    const TYPE_NO_CALLBACK_URL_SET = 'noCallbackUrlSet'; // When no callback url has been supplied, but a callback has been requested
    const TYPE_NO_TOKEN_FOUND = 'noTokenFound'; // Template should contain token
    const TYPE_NON_NUMERIC_CHARACTER = 'nonNumericCharacter'; // Numeric field contains non-numeric characters
    const TYPE_NOT_ALLOWED_FIELD = 'invalidFields'; // Unknown field has been send to the api
    const TYPE_NOT_BETWEEN  = 'notBetween'; // Field should be between twe specified value (inclusive)
    const TYPE_NOT_BETWEEN_STRICT = 'notBetweenStrict'; // Field should be between the specified values (exclusive)
    const TYPE_NOT_DIGITS = 'notDigits'; // Field should contain digits
    const TYPE_NOT_HEX = 'notHex'; // Field value contains invalid hexadecimal characters
    const TYPE_NOT_IN_ARRAY = 'notInArray'; // Field does not contain a valid value
    const TYPE_NOT_URI = 'notUri'; // Field does not contain an URL
    const TYPE_OUT_OF_RANGE = 'outOfRange'; // Scheduled delivery was not within allowed range
    const TYPE_RECIPIENT_LEADING_ZERO = 'recipientLeadingZero'; // Recipient should not start with a zero
    const TYPE_SENDER_EMPTY_STRING = 'senderEmptyString'; // Field shout not be empty
    const TYPE_SENDER_TOO_LONG = 'senderTooLong'; // Sender was too long
    const TYPE_STRING_EMPTY = 'digitsStringEmpty'; // Field should not be empty
    const TYPE_TOO_LONG  = 'stringLengthTooLong'; // Field value is too long
    const TYPE_TOO_MANY_PARTS = 'tooManyParts'; // Concat message with too many parts found
    const TYPE_TOO_SHORT = 'stringLengthTooShort'; // Field value is too short

    /**
     * @var int|null
     */
    protected $arrayIndex;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Error constructor
     *
     * @param string   $name
     * @param mixed    $value
     * @param string   $type
     * @param string   $message
     * @param int|null $arrayIndex
     */
    public function __construct($name, $value, $type, $message, $arrayIndex = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->message = $message;
        $this->arrayIndex = $arrayIndex;
    }

    /**
     * When the error field is an array: return the array index of which value generated the error; when not an array return null
     *
     * @return int|null
     */
    public function getArrayIndex()
    {
        return $this->arrayIndex;
    }

    /**
     * Return the error message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Return the name of the field which generated the error
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return a string to identify the type of error
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the value of the field which generated the error
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
