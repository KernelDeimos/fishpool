<?php

// Fixes headers/sessions when using PHPUnit
// This should not work, but it does
ob_start();

require_once('framework/Autoloader.php');

// Instantiate loader and add paths
$__LOADER = new Autoloader();
$__LOADER->add_class_path('framework');
$__LOADER->add_class_path('application');
$__LOADER->add_class_path('pages');
