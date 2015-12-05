<?php

namespace Pages;

use \Framework\TemplatePage;
use \Application\SitePage;
use \Application\AccountSession;

class LandingPage extends SitePage {
	function generate_page() {
		$main_template = $this->get_template();

		$account_session = $this->get_account_session();
		if ($account_session->check_login()){
			header('Location: ' . WEB_PATH."/user/".$account_session->get_account_id());
			return TemplatePage::PAGE_REDIRECT;
		}


		$landing_template = new \Framework\Template();
		$landing_template->set_template_file(SITE_PATH."/templates/landing.template.php");

		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");
		$main_template->contents_template = $landing_template;

		return TemplatePage::PAGE_OKAY;
	}
}