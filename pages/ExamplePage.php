<?php

namespace Pages;
use \Framework\ContentPage;

class ExamplePage extends ContentPage {
	function main($template) {
		$template->set_template_file(SITE_PATH."/templates/test.template.php");
		$template->title = "This is a Title";
		return  ContentPage::PAGE_OKAY;
	}
}
