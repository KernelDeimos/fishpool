<?php

namespace Pages;

use \Framework\TemplatePage;
use \Application\SitePage;
use \Application\AccountSession;

class LandingPage extends SitePage {
	function generate_page() {
		$landing_template = $this->get_page_template();

		$account_session = $this->get_account_session();
		if ($account_session->check_login()){
			header('Location: ' . WEB_PATH."/user/".$account_session->get_account_id());
			return SitePage::PAGE_REDIRECT;
		}

		$landing_template->set_template_file(SITE_PATH."/templates/landing.template.php");

		return SitePage::PAGE_OKAY;
	}
}