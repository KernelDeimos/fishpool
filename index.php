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
	$requestString = (isset($_GET['ri'])) ? $_GET['ri'] : '';
	$request = new \Framework\Request($requestString);
	
	$page = $request->get_page();

	if ($page === "" || $page === "index") {
		$pObject = new \Pages\LandingPage($request);
		$pObject->run();
	}
	else if ($page === "login") {
		$ex = new \Pages\LoginPage($request);
		$ex->run();
	}
	else if ($page === "register") {
		$ex = new \Pages\RegisterPage($request);
		$ex->run();
	}
	else if ($page === "register_submit") {
		$ex = new \Pages\RegisterSubmit($request);
		$ex->run();
	}
	else if ($page === "login_submit") {
		$ex = new \Pages\LoginSubmit($request);
		$ex->run();
	}
	else if ($page === "create_group") {
		$ex = new \Pages\NewGroupSubmit($request);
		$ex->run();
	}
	else if ($page === "create_project") {
		$ex = new \Pages\NewProjectSubmit($request);
		$ex->run();
	}
	else if ($page === "user") {
		$ex = new \Pages\UserPage($request);
		$ex->run();
	}
	else if ($page === "group") {

		$ex = new \Pages\GroupPage($request);
		$ex->run();
	}
	else {
		$ex = new \Pages\TemplateTestPage($request);
		$ex->run();
	}

}

try {
	main();
} catch (Exception $e) {
	//
}
