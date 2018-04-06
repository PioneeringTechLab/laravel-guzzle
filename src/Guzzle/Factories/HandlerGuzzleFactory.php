<?php

namespace CSUNMetaLab\Guzzle\Factories;

use CSUNMetaLab\Guzzle\Handlers\HandlerGuzzle;

class HandlerGuzzleFactory
{
	/**
	 * Returns a HandlerGuzzle instance based upon the default configuration.
	 *
	 * @return HandlerGuzzle
	 */
	public static function fromDefaults() {
		// resolve the client request options
		$client_options = [];
		$base_uri = config('guzzle.base_uri');
		if(!empty($base_uri)) {
			$client_options['base_uri'] = $base_uri;
		}

		// resolve the custom request options
		$request_options = [
			'verify' => config('guzzle.verify_cert'),
		];

		// if we have authentication options, set those too
		$username = config('guzzle.auth.username');
		$password = config('guzzle.auth.password');
		$method = config('guzzle.auth.method');

		// set the creds and optionally the method
		if(!empty($username) || !empty($password)) {
			$request_options['auth'] => [
				$username,
				$password,
			];
			if(!empty($method)) {
				$request_options['auth'][] = $method;
			}
		}

		return new HandlerGuzzle($client_options, $request_options);
	}
}