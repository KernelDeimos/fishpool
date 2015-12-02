<?php

namespace Pages;
use \Framework\ContentPage;

class LandingPage extends ContentPage {
	function main($main_template) {

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			// Attempt Login
		}

		$landing_template = new \Framework\Template();
		$landing_template->set_template_file(SITE_PATH."/templates/landing.template.php");

		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");
		$main_template->contents_template = $landing_template;

		return ContentPage::PAGE_OKAY;
	}
}
