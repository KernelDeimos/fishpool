<?php

namespace Pages;
use \Framework\ContentPage;

class LoginPage extends ContentPage {
	function main($main_template) {

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			// Attempt Login
		}

		$login_template = new \Framework\Template();
		$login_template->set_template_file(SITE_PATH."/templates/project_folder.template.php");

		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");
		$main_template->contents_template = $login_template;

		return ContentPage::PAGE_OKAY;
	}
}
