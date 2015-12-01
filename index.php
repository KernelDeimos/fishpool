<?php

// Include all framework classes
require_once('framework/Autoloader.php');

define('DEV_MODE', true);

function error_shutdown_function() {
	$err = error_get_last();
	if (DEV_MODE && $err) {
		echo "Error occured:<br />";
		echo "<pre>";
		print_r($err);
		echo "</pre>";
	}
}
register_shutdown_function('error_shutdown_function');

// Instantiate loader and add paths
$__LOADER = new Autoloader();
$__LOADER->add_class_path('framework');
$__LOADER->add_class_path('application');
$__LOADER->add_class_path('pages');

{
	// Define SITE_PATH variable (working directory)
	define('SITE_PATH',getcwd());
	// Define the WEB_PATH variable
	// (allows HTML pages to refer to specific locations more easily)
	$webpath = "http://".$_SERVER['HTTP_HOST']
		.dirname($_SERVER['PHP_SELF']);
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

	if ($page === "" || $page === "index") {
		$pObject = new \Pages\LandingPage();
		$pObject->run();
	}
	else if ($page === "login") {
		$ex = new \Pages\LoginPage();
		$ex->run();
	}
	else if ($page === "register") {
		$ex = new \Pages\RegisterPage();
		$ex->run();
	}
	else if ($page === "justins_page") {
		$ex = new \Pages\TestingPage();
		$ex->run();
	}
	else {
		$ex = new \Pages\TemplateTestPage();
		$ex->run();
	}


}

try {
	main();
} catch (Exception $e) {
	//
}
