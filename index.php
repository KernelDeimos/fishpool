<?php
// Include all framework classes
require_once('framework/Autoloader.php');

define('DEV_MODE', true);

// Instantiate loader and add paths
$__LOADER = new Autoloader();
$__LOADER->add_class_path('framework');
$__LOADER->add_class_path('application');
$__LOADER->add_class_path('pages');

// Define the WEB_PATH variable
// (allows HTML pages to refer to specific locations more easily)
{
	// Create a pattern for the current file-system path
	$pattern = '/^'.preg_quote($_SERVER['DOCUMENT_ROOT'],'/').'/';
	// Replace the match of this pattern with the host name (domain)
	$webpath = "http://".$_SERVER['HTTP_HOST'].preg_replace($pattern,'',getcwd());
	define('WEB_PATH',$webpath);
}

/**
 * Main website function
 *
 * This function determins the request being made, and routes
 * the request to  particular module.
 */
function main() {
	$requestString = (isset($_GET['ri'])) ? $_GET['ri'] : '';
	$request = new \Framework\Request($requestString);
	
	$page = $request->get_page();
	if ($page === "test") {
		$ex = new \Pages\ExamplePage();
		$ex->run();
	}
}

try {
	main();
} catch (Exception $e) {
	//
}
