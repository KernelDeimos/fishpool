<?php

namespace Pages;
use \Framework\ContentPage;
use \Application\AccountSession;

class SessionTestPage extends ContentPage {
	function main($template) {

		// Get instance of AccountSession
		$account_session = new AccountSession(null);

		$contents = new \Framework\Template();
		$contents->set_template_file(SITE_PATH."/templates/simple_message.template.php");

		$template->set_template_file(SITE_PATH."/templates/full.template.php");
		$template->contents_template = $contents;

		$contents->title = "Contents Page";
		if ($account_session->check_login()) {
			$contents->message = "Yes, logged in!";
		} else {
			$contents->message = "No, not logged in!";
		}

		return ContentPage::PAGE_OKAY;
	}
}
