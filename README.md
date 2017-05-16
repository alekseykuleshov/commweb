# Commweb api sdk

This is an api sdk for Commweb Payment Gateway.

## How to use

This sdk is installed via [Composer](http://getcomposer.org/). To install, simply add it to your `composer.json` file:

```json
{
    "require": {
        "atdev/commweb": "dev-master"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

Then, import the `autoload.php` from your `vendor` folder.

## Sample calls

Add the following to the php file which calls SDK:

```php
use ATDev\Commweb\PayRequest;
use ATDev\Commweb\AuthorizeRequest;
use ATDev\Commweb\CaptureRequest;
use ATDev\Commweb\VoidRequest;
use ATDev\Commweb\RefundRequest;
use ATDev\Commweb\Order;
use ATDev\Commweb\Transaction;
use ATDev\Commweb\SourceOfFundsCard;
use ATDev\Commweb\Card;
```

### PAY

```php
$result = (new PayRequest("MERCHANT_ID")) // Provided my gateway
    ->setApiPassword("API_PASSWORD") // Provided my gateway
    ->setOrder(new Order("SOME_ORDER_ID", 55.55, "AUD")) // Order id has to be unique, amount in money format, AUD is the only one supported now
    ->setTransaction(new Transaction("SOME_TRANSACTION_ID")) // Transaction id has to be unique
    ->setSourceOfFunds(new SourceOfFundsCard(new Card("CARD_NUMBER", "EXP_MONTH", "EXP_YEAR", "CVC"))) // Self explanatory, year is 2-digit
    ->send();

if ( ! empty($error = $result->getError()) ) {
    // Something went wrong, log it
    die($error);
}

// Successful, save order id, transaction id
```

### AUTHORIZE

```php
$result = (new AuthorizeRequest("MERCHANT_ID")) // Provided my gateway
    ->setApiPassword("API_PASSWORD") // Provided my gateway
    ->setOrder(new Order("SOME_ORDER_ID", 55.55, "AUD")) // Order id has to be unique, amount in money format, AUD is the only one supported now
    ->setTransaction(new Transaction("SOME_TRANSACTION_ID")) // Transaction id has to be unique
    ->setSourceOfFunds(new SourceOfFundsCard(new Card("CARD_NUMBER", "EXP_MONTH", "EXP_YEAR", "CVC"))) // Self explanatory, year is 2-digit
    ->send();

if ( ! empty($error = $result->getError()) ) {
    // Something went wrong, log it
    die($error);
}

// Successful, save order id, transaction id
```

### VOID

```php
$result = (new VoidRequest("MERCHANT_ID")) // Provided my gateway
    ->setApiPassword("API_PASSWORD") // Provided my gateway
    ->setOrder(new Order("SOME_ORDER_ID")) // Original order id
    ->setTransaction(new Transaction("SOME_TRANSACTION_ID")) // New transaction id to be created, has to be unique
    ->setOldTransaction(new Transaction(("OLD_TRANSACTION_ID")) // Original transaction id
    ->send();

if ( ! empty($error = $result->getError()) ) {
    // Something went wrong, log it
    die($error);
}

// Successful, save order id, transaction id
```

### CAPTURE

```php
$result = (new CaptureRequest("MERCHANT_ID")) // Provided my gateway
    ->setApiPassword("API_PASSWORD") // Provided my gateway
    ->setOrder(new Order("SOME_ORDER_ID")) // Original order id
    ->setTransaction(new Transaction("SOME_TRANSACTION_ID")) // New transaction id to be created, has to be unique
    ->setOldTransaction(new Transaction("OLD_TRANSACTION_ID", 55.55, "AUD")) // Original transaction id, amount to capture in money format, AUD is the only one supported now
    ->send();

if ( ! empty($error = $result->getError()) ) {
    // Something went wrong, log it
    die($error);
}

// Successful, save order id, transaction id
```

### REFUND

```php
$result = (new RefundRequest("MERCHANT_ID")) // Provided my gateway
    ->setApiPassword("API_PASSWORD") // Provided my gateway
    ->setOrder(new Order("SOME_ORDER_ID")) // Original order id
    ->setTransaction(new Transaction("SOME_TRANSACTION_ID")) // New transaction id to be created, has to be unique
    ->setOldTransaction(new Transaction("OLD_TRANSACTION_ID", 55.55, "AUD")) // Original transaction id, amount to refund in money format, AUD is the only one supported now
    ->send();

if ( ! empty($error = $result->getError()) ) {
    // Something went wrong, log it
    die($error);
}

// Successful, save order id, transaction id
```

## Test mode

Just add "TEST" to your merchant id if it's not already here, or call `setTestMode(true)` method for any request called.
