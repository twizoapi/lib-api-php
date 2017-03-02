<?php

namespace Twizo\Examples\Util;

/**
 * Util class to format entities used in example files
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class EntityFormatter
{
    /**
     * Retrieve all getter function values from object
     *
     * @param \Twizo\Api\AbstractEntity $entity
     *
     * @return array
     */
    public static function getEntityValues(\Twizo\Api\AbstractEntity $entity)
    {
        $result = array();
        $methods = get_class_methods($entity);
        sort($methods);
        foreach ($methods as $method) {
            if (substr($method, 0, 3) == 'get') {
                $result[$method] = $entity->$method();
            }
        }

        return $result;
    }

    /**
     * Print all entity values to console
     *
     * @param \Twizo\Api\AbstractEntity $entity
     */
    public static function dumpEntity(\Twizo\Api\AbstractEntity $entity)
    {
        print self::getEntity($entity);
    }

    /**
     * Generate string with entity class name and a list of the entity values
     *
     * @param \Twizo\Api\AbstractEntity $entity
     *
     * @return string
     */
    public static function getEntity(\Twizo\Api\AbstractEntity $entity)
    {
        $result = '';
        $values = self::getEntityValues($entity);

        $result .= str_repeat('-', strlen(get_class($entity)) + 4) . PHP_EOL;
        $result .= '| ' . get_class($entity) . ' |' . PHP_EOL;
        $result .= str_repeat('-', strlen(get_class($entity)) + 4) . PHP_EOL;

        foreach ($values as $method => $value) {
            $result .= substr($method, 3) . ' : ' . var_export($value, true) . PHP_EOL;
        }

        return $result;
    }
}
