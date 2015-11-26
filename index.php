<?php

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

}

try {
	main();
} catch (Exception $e) {
	//
}

echo "The query string is: " . $_SERVER['QUERY_STRING'];
echo "<br />";
echo "The RI is: " . $_GET['ri'];
