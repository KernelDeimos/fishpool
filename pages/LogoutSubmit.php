<?php

namespace Pages;
use \Framework\ContentPage;
use \Application\AccountSession;


class LogoutSubmit extends ContentPage {
	function main($template) {
		$account_session = new AccountSession (null);
		$account_session->logout();
		header("Location: " . WEB_PATH);
		return ContentPage::PAGE_REDIRECT;
	}
}
