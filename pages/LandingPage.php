<?php

namespace Pages;
use \Framework\ContentPage;

class LandingPage extends ContentPage {
	function main($template) {
		$template->set_template_file(SITE_PATH."/templates/landing.template.php");
		return ContentPage::PAGE_OKAY;
	}
}
