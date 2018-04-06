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

		return new HandlerGuzzle($client_options, $request_options);
	}
}