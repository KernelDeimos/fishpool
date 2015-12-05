<?php

namespace Pages;
use \Framework\ContentPage;
use \Application\AccountSession;

class LandingPage extends ContentPage {
	function main($main_template) {

		$account_session = new AccountSession(null);
		if ($account_session->check_login()){
			header('Location: ' . WEB_PATH."/user/".$account_session->get_account_id());
			return ContentPage::PAGE_REDIRECT;
		}


		$landing_template = new \Framework\Template();
		$landing_template->set_template_file(SITE_PATH."/templates/landing.template.php");

		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");
		$main_template->contents_template = $landing_template;

		return ContentPage::PAGE_OKAY;
	}
}