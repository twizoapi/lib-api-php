![Twizo](http://www.twizo.com/online/logo/twizo-logo.png) 


# Twizo PHP API #

Connect to the Twizo API using PHP. This API includes functions to send verifications (2FA), SMS and Number Lookup.

## Requirements ##
* PHP >= 5.4
* Composer

## Get application secret and api host ##
To use the Twizo API client, the following things are required:

* Create a [Twizo account](https://register.twizo.com/)
* Login on the Twizo portal
* Find your [application](https://portal.twizo.com/applications/) secret
* Find your nearest api [node](https://www.twizo.com/developers/documentation/#introduction_api-url)

## Installation ##

The easiest way to start using the the Twizo API is to require it with [Composer](http://getcomposer.org/doc/00-intro.md).

	$ composer require twizo/lib-api-php

## Getting started ##

Use the auto loader to load all required classes. If you're using Composer, you can skip this step and use the composer auto loader.

```php
require "autoload.php";
```

Initializing the Twizo Api using your api secret and api host

```php
$twizo = Twizo\Api\Twizo::getInstance('43reFDSrewrfet425rtefdGDSGds54twegdsgHaFST2refwd', 'api-asia-01.twizo.com');
	
```

Create a new verification

```php
$verification = $twizo->createVerification('610123456789');
$verification->send();
```

Verify token

```php
try {
    $result = $twizo->getTokenResult($verification->getMessageId(), '12345');

    print 'Success' . PHP_EOL;
} catch (Verification\Exception $e) {
    print 'Failed: ' . $e->getMessage() . PHP_EOL;
} catch (Twizo\Api\Exception $e) {
    print 'Exception: ' . $e->getMessage() . PHP_EOL;
}
```

Send sms

```php
$sms = $twizo->createSms('test message body', '610123456789', 'sender');
$sms->sendSimple();
```

## Examples ##

In the examples directory you can find a collection of cli examples of how to use the api.
When first running an example you will be asked for a host name and secret; this will be written to a config file.

## License ##
[The MIT License](https://opensource.org/licenses/mit-license.php).
Copyright (c) 2016-2017 Twizo

## Support ##
Contact: [www.twizo.com](http://www.twizo.com/) — support@twizo.com
