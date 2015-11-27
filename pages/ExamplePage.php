<?php

namespace Pages;
use \Framework\ContentPage;

class ExamplePage extends ContentPage {
	function main(&$template) {
		echo "pie";
		return  ContentPage::PAGE_REDIRECT;
	}
}
