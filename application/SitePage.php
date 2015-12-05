 
<?php

namespace Application;
use \Application\AccountSession;

abstract class SitePage extends TemplatePage {

	private $page_template;
	private $account_session;

	function __construct($request, $account_session) {
		parent::__construct($request);
		$this->account_session = $account_session;
	}

	function setup_site_template() {
		// Get main template for parent TemplatePage
		$main_template = $this->get_template();

		// Set the main template to the site template
		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");

		if ( $account_session->check_login() ) {
			$main_template->has_account = true;
		}
	}

	function main() {
		$this->setup_site_template();

		$this->page_template = new Template();

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			$this->do_post();
		}

		$this->generate_page();
	}

}
