<?php
namespace Twizo\Api;

/**
 * Auto loader for Twizo classes
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class AutoLoader
{
    /**
     * @var string
     */
    protected $baseDir;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baseDir = __DIR__;
        $this->prefix = __NAMESPACE__;
    }

    /**
     * @param string $class
     */
    public function autoload($class)
    {
        // Does the class use the namespace prefix?
        $len = strlen($this->prefix);
        if (strncmp($this->prefix, $class, $len) !== 0) {
            // If not, use the next autoloader
            return;
        }

        // Get the relative class name
        $relativeClass = substr($class, $len);

        // Generate file name
        $file = $this->baseDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }

    /**
     * @return bool
     */
    public function register()
    {
        return spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * @return bool
     */
    public function unRegister()
    {
        return spl_autoload_unregister(array($this, 'autoload'));
    }
}
