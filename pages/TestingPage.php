<?php

namespace Pages;
use \Framework\ContentPage;

class TestingPage extends ContentPage {
	function main($template) {
		$template->set_template_file(SITE_PATH."/templates/justins_page.template.php");
		$template->title = "This is inside those h1 tags";
		return  ContentPage::PAGE_OKAY;
	}
}
