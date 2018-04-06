<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Should Guzzle verify the server certificate for HTTPS requests?
    |--------------------------------------------------------------------------
    |
    | Should Guzzle verify the server certificate during HTTPS requests? This
    | typically requires the CA cert of the server's chain to be installed on
    | the machine performing the Guzzle request.
    |
    | During development, this can be set to false safely. You may also want to
    | set this to false when using WAMP since WAMP tends to have issues with
    | Guzzle when attempting to verify the server certificate.
    |
    | Default is true.
    |
    */
    'verify_cert' => env("GUZZLE_VERIFY_CERT", true),

];