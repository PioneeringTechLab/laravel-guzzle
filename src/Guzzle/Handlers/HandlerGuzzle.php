<?php

namespace CSUNMetaLab\Guzzle\Handlers\HandlerGuzzle;

use GuzzleHttp\Client;

class HandlerGuzzle
{
	/**
	 * Associative array of Guzzle client options.
	 *
	 * @var array
	 */
	private $client_options;

	/**
	 * Associative array of request options.
	 *
	 * @var array
	 */
	private $request_options;

	/**
	 * Instance of a Guzzle client.
	 *
	 * @var \GuzzleHttp\Client
	 */
	private $client;

	/**
	 * Constructs a new instance of HandlerGuzzle.
	 *
	 * @param array $client_options Optional array of Guzzle client options
	 * @param array $request_options Optional array of request options
	 */
	public function __construct($client_options=[], $request_options=[]) {
		$this->client_options = $client_options;
		$this->request_options = $request_options;

		$this->client = new Client($client_options);
	}

	/**
	 * Convenience method to clear the authentication credentials and method
	 * used in the request. Returns whether the authentication options were
	 * cleared successfully.
	 *
	 * @return bool
	 */
	public function clearAuth() {
		return $this->clearRequestOption('auth');
	}

	/**
	 * Clears a request option if it exists. Returns whether the option was
	 * cleared successfully.
	 *
	 * @param string $key The key of the option to clear
	 * @return bool
	 */
	public function clearRequestOption($key) {
		if(array_key_exists($key, $this->request_options)) {
			unset($this->request_options[$key]);
			return true;
		}
		return false;
	}

	/**
	 * Returns the Guzzle client instance.
	 *
	 * @return \GuzzleHttp\Client
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * Returns the array of Guzzle client options.
	 *
	 * @return array
	 */
	public function getClientOptions() {
		return $this->client_options;
	}

	/**
	 * Returns the array of request options.
	 *
	 * @return array
	 */
	public function getRequestOptions() {
		return $this->request_options;
	}

	/**
	 * Convenience method to set the request authentication options.
	 *
	 * @param string $username The authentication username
	 * @param string $password The authentication password
	 * @param string $method Optional authentication method string
	 */
	public function setAuth($username, $password, $method=null) {
		$this->request_options['auth'] => [
			$username,
			$password,
		];

		if(!empty($method)) {
			$this->request_options['auth'][] = $method;
		}
	}

	/**
	 * Sets a request option prior to a request.
	 *
	 * @param string $key The key of the option
	 * @param mixed $value The value of the option
	 */
	public function setRequestOption($key, $value) {
		$this->request_options[$key] = $value;
	}

	/**
	 * Sets an associative array of request options prior to a request.
	 *
	 * @param array $options Associative array of options to set
	 */
	public function setRequestOptionArray($options) {
		foreach($options as $key => $value) {
			$this->request_options[$key] = $value;
		}
	}
}