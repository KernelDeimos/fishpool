<?php

class Autoloader {

	private $paths;

	function __construct() {
		$this->paths = [];
		spl_autoload_register(function ($classIdentifier) {
			$this->attempt_loading($classIdentifier);
		});
	}
	function attempt_loading($classIdentifier) {
		// Create an array of components of the class namespace
		$classNamespace = explode("\\", $classIdentifier);
		// Select last element of classNamespace as the class name
		$className = $classNamespace[count($classNamespace)-1];
		
		// Check each possible class path
		foreach ($this->paths as $path) {
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
	function add_class_path($path) {
		$this->paths[] = $path;
	}
}
