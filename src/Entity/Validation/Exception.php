<?php

namespace Twizo\Api\Entity\Validation;

use Twizo\Api\Entity;

/**
 * Entity validation exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Exception extends Entity\Exception
{
    /**
     * @var ErrorField[]
     */
    protected $errorFields;

    /**
     * Parse validation messages from api and generate exception
     *
     * @param array    $validationFields
     * @param array    $postFields
     * @param int|null $statusCode
     * @param int|null $jsonErrorCode
     */
    public function __construct(array $validationFields, $postFields, $statusCode = null, $jsonErrorCode = null)
    {
        // Loop through all validation fields
        foreach ($validationFields as $field => $errorMessages) {
            $this->setErrorField($field, isset($postFields[$field]) ? $postFields[$field] : null, $errorMessages);
        }
        $exceptionMessages = array();
        foreach ($this->errorFields as $errorField) {
            $exceptionMessages[] = sprintf('Validation error for field "%s" : %s', $errorField->getName(), $errorField->getMessage());
        }

        parent::__construct(implode(', ', $exceptionMessages), self::VALIDATION_ERRORS, $statusCode, $jsonErrorCode);
    }

    /**
     * @return ErrorField[]
     */
    public function getErrorFields()
    {
        return $this->errorFields;
    }

    /**
     * Add all validation messages for one field
     *
     * @param string $name
     * @param mixed  $value
     * @param array  $messages
     * @param int    $arrayIndex
     */
    protected function setErrorField($name, $value, $messages, $arrayIndex = null)
    {
        // Loop through all errors
        foreach ($messages as $errorType => $error) {
            // When the validation messages are about an array, they are set in a sub array (validation_errors)
            if (is_numeric($errorType) && is_array($error) && isset($error['validation_errors'])) {
                // Array index is 1 based so deduct one to create 0 based index
                $arrayIndex = ((int) $errorType) - 1;
                $this->setErrorField(
                    $name,
                    isset($value[$arrayIndex]) ? $value[$arrayIndex] : null,
                    $error['validation_errors'],
                    $arrayIndex
                );
            } elseif (is_array($error)) {
                // When there is an array of errors returned, handle them recursively
                $this->setErrorField($name, $value, $error, $arrayIndex);
            } else {
                // Add error field with all information
                $this->errorFields[] = new ErrorField($name, $value, $errorType, $error, $arrayIndex);
            }
        }
    }
}
