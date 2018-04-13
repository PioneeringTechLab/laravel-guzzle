# Laravel Guzzle

Composer package for Laravel 5.0 and above that provides a consistent method of interacting with Guzzle.

This package is intended to be used to interact with JSON web services but it can also be used with any kind of request endpoint. It provides a basic interface with which to make requests but there is also the option to interact with the underlying Guzzle client instance directly if you need more robust functionality.

## Table of Contents

* [Installation](#installation)
    * [Composer and Service Provider](#composer-and-service-provider)
    * [Middleware Installation](#middleware-installation)
    * [Publish Everything](#publish-everything)
* [Required Environment Variables](#required-environment-variables)
* [Optional Environment Variables](#optional-environment-variables)
    * [Authentication Options](#authentication-options)
    * [Client Options](#client-options)
    * [Other Request Options](#other-request-options)
* [Resources](#resources)

## Installation

### Composer and Service Provider

#### Composer

To install from Composer, use the following command:

```
composer require csun-metalab/laravel-guzzle
```

#### Service Provider

Add the service provider to your `providers` array in `config/app.php` in Laravel as follows:

```
'providers' => [
   //...

   CSUNMetaLab\Guzzle\Providers\GuzzleServiceProvider::class,

   // You can also use this based on Laravel convention:
   // 'CSUNMetaLab\Guzzle\Providers\GuzzleServiceProvider',

   //...
],
```

### Publish Everything

Finally, run the following Artisan command to publish everything:

```
php artisan vendor:publish
```

The following assets are published:

* Configuration (tagged as `config`) - these go into your `config` directory

## Required Environment Variables

There are currently no required environment variables but there are [optional environment variables](#optional-environment-variables).

## Optional Environment Variables

### Authentication Options

#### GUZZLE_AUTH_USERNAME

This is the authentication username that will be used for all default Guzzle requests. This value will only be consulted when resolving a `HandlerGuzzle` instance from the `HandlerGuzzleFactory` class.

It will not affect `HandlerGuzzle` objects that have been instantiated directly.

If either the username or password have been provided and are non-empty then the authentication credentials will be set.

Default is `null`.

#### GUZZLE_AUTH_PASSWORD

This is the authentication password that will be used for all default Guzzle requests. This value will only be consulted when resolving a `HandlerGuzzle` instance from the `HandlerGuzzleFactory` class.

It will not affect `HandlerGuzzle` objects that have been instantiated directly.

If either the username or password have been provided and are non-empty then the authentication credentials will be set.

Default is `null`.

#### GUZZLE_AUTH_METHOD

This is the authentication method that will be used for all default Guzzle requests. This value will only be consulted when resolving a `HandlerGuzzle` instance from the `HandlerGuzzleFactory` class.

It will not affect `HandlerGuzzle` objects that have been instantiated directly.

Allowed values are `null` (HTTP Basic Authentication), `digest`, and `ntlm`.

Default is `null`.

### Client Options

#### GUZZLE_BASE_URI

This is the base URI that will be used for all default Guzzle requests. This value is only consulted when resolving a `HandlerGuzzle` instance from the `HandlerGuzzleFactory` class.

It will not affect `HandlerGuzzle` objects that have been instantiated directly.

Default is `null`.

### Other Request Options

#### GUZZLE_JSON_ASSOC_ARRAY

Should Guzzle return a JSON response body as an associative array when using the `resolveResponseBody()` method in `HandlerGuzzle`?

The default in Guzzle 5.x was to return a response body as an associative array when using the `json()` response method. Guzzle 6.x does not have a `json()` response method so this can be set to true in order to maintain the original functionality.

Default is `false` (i.e. return the JSON response as a `StdClass` instance).

#### GUZZLE_VERIFY_CERT

Should Guzzle verify the server certificate during HTTPS requests? This typically requires the CA cert of the server's chain to be installed on the machine performing the Guzzle request.

During development, this can be set to `false` safely. You may also want to set this to `false` when using WAMP since WAMP tends to have issues with Guzzle when attempting to verify the server certificate.

Default is `true`.

## Resources

### Guzzle

* [Guzzle](http://guzzle.readthedocs.io/en/latest/overview.html)
* [Guzzle Requests](http://guzzle.readthedocs.io/en/latest/quickstart.html#making-a-request)
* [Guzzle Responses](http://guzzle.readthedocs.io/en/latest/quickstart.html#using-responses)