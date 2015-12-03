<?php
namespace Pages;
use \Framework\ContentPage;

class UserPage extends ContentPage {
	function main($main_template) {
		$account_session = new AccountSession(null);
		
		$user_template = new \Framework\Template();
		$user_template->set_template_file(SITE_PATH."/templates/user.template.php");

		if ($account_session->check_login()) {
			$user_template->login = true;
		} else {
			$user_template->login = false;
		}

		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");
		$main_template->contents_template = $login_template;
		return ContentPage::PAGE_OKAY;
	}
}