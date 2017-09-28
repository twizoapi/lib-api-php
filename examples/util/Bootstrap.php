<?php

namespace Twizo\Examples\Util;

/**
 * Bootstrap file for the example files
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Bootstrap
{
    /**
     * @var string
     */
    protected $baseDir;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Only allow examples to be run on command line
        if (php_sapi_name() !== "cli") {
            throw new \RuntimeException('Examples can only be run on command line');
        }

        $this->baseDir = realpath(__DIR__ . '/../../');
    }

    /**
     * Configure php to display errors and load all required file
     */
    public function init()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Load composer auto loader or when not available the Twizo auto loader
        if (file_exists($this->baseDir . '/vendor/autoload.php')) {
            require_once($this->baseDir . '/vendor/autoload.php');
        } else {
            require_once($this->baseDir . '/autoload.php');
        }

        require_once($this->baseDir . '/examples/util/EntityFormatter.php');
    }

    /**
     * Load config file when it exists; otherwise create it by asking the user on command line for the required files
     */
    public function loadConfig()
    {
        // Load / create config file
        if (file_exists($this->baseDir . '/examples/config.php')) {
            include_once($this->baseDir . '/examples/config.php');
        } else {
            define('SECRET', readline('Secret: '));
            define('API_HOST', readline('Api host: '));

            $configTemplate = "<?php" . PHP_EOL
                . "define('SECRET', %s);" . PHP_EOL
                . "define('API_HOST', %s);" . PHP_EOL;

            file_put_contents(
                $this->baseDir . '/examples/config.php',
                sprintf(
                    $configTemplate,
                    var_export(SECRET, true),
                    var_export(API_HOST, true)
                )
            );
        }
    }
}

$bootstrap = new Bootstrap();
$bootstrap->init();
$bootstrap->loadConfig();
