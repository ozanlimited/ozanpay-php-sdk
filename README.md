# ozanpay-php-sdk

![Home Image](https://raw.githubusercontent.com/ozanlimited/ozanpay-php-sdk/master/docs/ozan-banner.jpg)

__Welcome to Ozan Pay PHP SDK__. This repository contains Ozan Pay's PHP SDK.

# Requirements

PHP 5.3 and above.

# Contact Us

If you have any questions, please create an issue on Github or contact us at itsupport@ozan.com.

# Installation

### Composer

You can install the sdk via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require ozanlimited/ozanpay-php-sdk
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

# Usage

```php
try {
    $ozan = new Ozan\Ozan([
        'api_key' => 'OZAN-MERCHANT-API-KEY',
        'secret_key' => 'OZAN-MERCHANT-SECRET-KEY',
        'is_live' => false,
    ]);
    
    $request = new PaymentRequest();
    $request->setCheckoutToken('tlqUxDrGeSaCPaC+Dt/+dBZMdwqe8uZOWnqnVcShUCmPL0kOffEYSf5y91ltG8CxCO83wvHAcbBDdYldisyjzCSzjINXHk4fvaPHyAtMx9w=');
    $request->setAmount(123.45);
    $request->setCurrency('GBP');
    $paymentResponse = $ozan->createPayment($request);
    $payment = $paymentResponse->getPayment();
    
    echo 'Payment id: ' . $payment->getPaymentId();
    echo 'Payment status: ' . $payment->getStatus();
} catch (OzanResponseException $e) {
    // When Ozan API returns an error
    echo 'Ozan API returned an error: ' . $e->getErrorDescription();
    echo 'Ozan error code: ' . $e->getErrorCode();
    exit;
}
```