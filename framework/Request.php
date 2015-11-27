<?php

namespace Framework;

class Request {
	private $pathArray;


	function __construct($requestString) {
		// Parse URL codes in the string
		$requestString = urldecode($requestString);
		// Remove invalid characters from the string
		$requestString = preg_replace('/[^0-9A-z_\/\s-]/', '', $requestString);
		// Generate path array from string (use delimiter of '/' or '\')
		$pathArray = preg_split('(/+,\\+)', $requestString);
		// Set instance variable
		$this->pathArray = $pathArray;
	}

	function dump_request_string() {
		return implode('.', $this->pathArray);
	}

	/**
	 * Get the page name
	 *
	 * Returns the very first item in the request's path.
	 * Returns an empty string or a string containing the
	 * first item.
	 *
	 * Example:
	 * pageName/2/some-item
	 * calling thus function would return pageName
	 *
	 * @return string the page name
	*/
	function get_page() {
		return $pathArray[0];
	}

	/**
	 * Get a Parameter
	 *
	 * Obtains a deeper item in the URL path than
	 * the root item, using indexes starting at
	 * zero. Returns null if parameter does not exist.
	 *
	 * Example:
	 * pageName/2/some-item
	 * the index 0 returns '2',
	 * the index 1 returns 'some-item'
	 *
	 * @param ind the index of the parameter to retrieve
	 * @return mixed the parameter's value, or null
	 */
	function get_parameter($ind) {
		// Store pathArray in a local variable
		$pathArray = $this->pathArray;
		// Start at second value of path array
		$ind += 1;
		// Determine if a parameter exists here (AND IS NOT NULL!)
		if (isset($pathArray)) {
			// Return item if it exists
			return $this->pathArray[$ind];
		} else {
			// Return null if we didn't find anything
			return null;
		}
	}
}