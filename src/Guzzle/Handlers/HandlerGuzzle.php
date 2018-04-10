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
	 * Clears all request headers if any exist. Returns whether the headers
	 * were cleared successfully.
	 *
	 * @return bool
	 */
	public function clearAllHeaders() {
		if(array_key_exists('headers', $this->request_options)) {
			unset($this->request_options['headers']);
			return true;
		}
		return false;
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
	 * Clears a request header if it exists. Returns whether the header was
	 * cleared successfully.
	 *
	 * @param string $key The key of the header to clear
	 * @return bool
	 */
	public function clearHeader($key) {
		if(array_key_exists('headers', $this->request_options)) {
			if(array_key_exists($key, $this->request_options['headers'])) {
				unset($this->request_options['headers'][$key]);
				return true;
			}
		}
		return false;
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * went wrong with the request. Returns the Guzzle response instance.
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
	 * Sets the body data of a request. This works differently depending on
	 * the Guzzle version that is used.
	 *
	 * In Guzzle 5.x, this can be used to set form data as the body. In Guzzle
	 * 6.x, this can only be used to set regular text or stream data.
	 *
	 * For form, JSON, or multipart data, please use the respective methods in
	 * order to be safe.
	 *
	 * @param mixed $data The body data to set
	 * @see https://github.com/guzzle/guzzle/blob/master/UPGRADING.md#post-requests
	 *
	 * @see HandlerGuzzle#setFormBody
	 * @see HandlerGuzzle#setJsonBody
	 * @see HandlerGuzzle#setMultipartData
	 */
	public function setBody($data) {
		$this->request_options['body'] = $data;
	}

	/**
	 * Sets the request body data of an application/x-www-form-urlencoded request.
	 *
	 * @param array $data The array of data to set as the request body
	 */
	public function setFormBody($data) {
		// check whether there is a request() method present to determine
		// the Guzzle capabilities and what array key to set
		if(method_exists($this->client, 'request')) {
			$this->request_options['form_params'] = $data;
		}
		else
		{
			// set the Content-Type header but don't replace it
			$this->setHeader('Content-Type', 'application/x-www-form-urlencoded', false);
			$this->setBody($data);
		}
	}

	/**
	 * Sets a request header with the given key and value.
	 *
	 * @param string $key The key of the header
	 * @param mixed $value The value of the header
	 * @param bool $replace Whether to replace the existing header. Defaults to true.
	 */
	public function setHeader($key, $value, $replace=true) {
		if(array_key_exists('headers', $this->request_options)) {
			if(array_key_exists($key, $this->request_options['headers']))
				if($replace) {
					// header exists and we want to replace it
					$this->request_options['headers'][$key] = $value;
				}
			}
			else
			{
				// header does not yet exist, so create it
				$this->request_options['headers'][$key] = $value;
			}
		}
		else
		{
			// no custom request headers yet, so create the headers array and add
			// the custom header to it
			$this->request_options['headers'][$key] = $value;
		}
	}

	/**
	 * Sets the request body data of an application/json request.
	 *
	 * @param array $data The array of data to set as the request body
	 */
	public function setJsonBody($data) {
		// check whether there is a request() method present to determine
		// the Guzzle capabilities and what array key to set
		if(method_exists($this->client, 'request')) {
			$this->request_options['json'] = $data;
		}
		else
		{
			// set the Content-Type header but don't replace it
			$this->setHeader('Content-Type', 'application/json', false);
			$this->setBody($data);
		}
	}

	/**
	 * Sets the request body data of a multipart/form-data request.
	 *
	 * @param array $data The array of data to set as the request body
	 */
	public function setMultipartBody($data) {
		// check whether there is a request() method present to determine
		// the Guzzle capabilities and what array key to set
		if(method_exists($this->client, 'request')) {
			$this->request_options['multipart'] = $data;
		}
		else
		{
			// set the Content-Type header but don't replace it
			$this->setHeader('Content-Type', 'multipart/form-data', false);
			$this->setBody($data);
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

	/**
	 * Magic method to make requests via instance method syntax. Returns the
	 * Guzzle response via the executeRequest() method. Throws an instance of
	 * BadMethodCallException if no arguments have been provided.
	 *
	 * @param string $name The name of the HTTP method to use
	 * @param array $arguments Array of arguements; only the first will be used
	 * 
	 * @return mixed
	 *
	 * @throws GuzzleHttp\Exception\RequestException
	 * @throws BadMethodCallException
	 */
	public function __call($name, $arguments) {
		$method = strtoupper($name);
		if(!empty($arguments)) {
			return $this->executeRequest($method, $arguments[0]);
		}

		throw new \BadMethodCallException(
			'You must provide a URI argument in your call to ' . $name . '()'
		);
	}
}