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