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
	 * Executes a DELETE request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function delete($uri) {
		return $this->executeRequest('DELETE', $uri);
	}

	/**
	 * Executes a Guzzle request with the specified HTTP method and URI. All
	 * request options that have already been set will be used here. Throws a
	 * RequestException if something went wrong with the request. Returns the
	 * Guzzle response instance.
	 *
	 * @param string $method The HTTP method to use
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function executeRequest($method, $uri) {
		// we have to take the Guzzle version into account here; the 6.x series
		// has the request() method whereas the 5.x series only has magic
		// methods based upon the HTTP request verb so we will need to create
		// a request explicitly to leverage equivalent functionality
		if(method_exists($this->client, 'request')) {
			$response = $this->client->request($method, $uri, $this->request_options);
		}
		else
		{
			$request = $this->client->createRequest($method, $uri, $this->request_options);
			$response = $this->client->send($request);
		}
		return $response;
	}

	/**
	 * Executes a GET request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function get($uri) {
		return $this->executeRequest('GET', $uri);
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
	 * Executes a HEAD request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function head($uri) {
		return $this->executeRequest('HEAD', $uri);
	}

	/**
	 * Executes a OPTIONS request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function options($uri) {
		return $this->executeRequest('OPTIONS', $uri);
	}

	/**
	 * Executes a PATCH request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function patch($uri) {
		return $this->executeRequest('PATCH', $uri);
	}

	/**
	 * Executes a POST request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function post($uri) {
		return $this->executeRequest('POST', $uri);
	}

	/**
	 * Executes a PUT request with the specified URI. All request options that
	 * have already been set will be used. Throws a RequestException if something
	 * went wrong with the request. Returns the response body with a type
	 * depending on the type of response format requested.
	 *
	 * @param string $uri The URI endpoint
	 *
	 * @return mixed
	 * @throws GuzzleHttp\Exception\RequestException
	 */
	public function put($uri) {
		return $this->executeRequest('PUT', $uri);
	}

	/**
	 * Resolves the body of a Guzzle response in the specified format. If the
	 * format is "json" then the body will be passed through json_decode()
	 * before being returned. Otherwise, the body (typically a stream) will be
	 * returned directly without modification.
	 *
	 * @param mixed $response The Guzzle response instance
	 * @param string $format Optional format (either null or "json")
	 *
	 * @return mixed
	 */
	public function resolveResponseBody($response, $format=null) {
		$body = $response->getBody();

		if($format == 'json') {
			return json_decode($body);
		}

		return $body;
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