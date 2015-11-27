<?php

class Autoloader {

	private $paths;

	function __construct() {
		$this->paths = [];
		spl_autoload_register(function ($className) {
			$this->attempt_loading($className);
		});
	}
	function attempt_loading($className) {
		// Check each possible class path
		for ($this->paths as $path) {
			// Generate expected path of file
			$fullPath = $path.'/'.$className.'.php';
			// Check if file exists
			if (file_exists($fullPath)) {
				// Load the file
				require_once($fullPath);
				if (class_exists($className)) {
					break;
				}
			}
		}
	}
}