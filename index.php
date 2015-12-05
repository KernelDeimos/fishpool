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
 * This function determines the request being made, and routes
 * the request to  particular module.
 */
function main() {
	// Start the session manager
	session_start();

	// Create request object from query
	$requestString = (isset($_GET['ri'])) ? $_GET['ri'] : '';
	$request = new \Framework\Request($requestString);
	
	// Get page name from request
	$page = $request->get_page();

	if ($page === "" || $page === "index") {
		$pObject = new \Pages\LandingPage($request);
		$pObject->run();
	}
	else if ($page === "login") {
		$page_object = new \Pages\LoginPage($request);
	}
	else if ($page === "register") {
		$page_object = new \Pages\RegisterPage($request);
	}
	else if ($page === "register_submit") {
		$page_object = new \Pages\RegisterSubmit($request);
	}
	else if ($page === "login_submit") {
		$page_object = new \Pages\LoginSubmit($request);
	}
	else if ($page === "UpDownCode") {
		$page_object = new \Pages\UpDownCode();
	}
	else if ($page === "create_group") {
		$page_object = new \Pages\NewGroupSubmit($request);
	}
	else if ($page === "create_project") {
		$page_object = new \Pages\NewProjectSubmit($request);
	}
	else if ($page === "user") {
		$page_object = new \Pages\UserPage($request);
	}
	else if ($page === "group") {

		$page_object = new \Pages\GroupPage($request);
	}
	else if ($page === "logout") {

		$page_object = new \Pages\LogoutSubmit($request);
	}
	else {
		$page_object = new \Pages\TemplateTestPage($request);
	}

	$page_object->run();

}

try {
	main();
} catch (Exception $e) {
	//
}
