<?php

namespace Application;
use \Framework\Template;
use \Framework\TemplatePage;
use \Application\AccountSession;

abstract class SitePage extends TemplatePage {

	private $page_template;
	private $account_session;

	function __construct($request) {
		parent::__construct($request);

		$this->account_session = new AccountSession();
	}

	function setup_site_template() {
		// Get main template for parent TemplatePage
		$main_template = $this->get_template();

		// Set the main template to the site template
		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");

		if ( $this->account_session->check_login() ) {
			$main_template->has_account = true;
		} else {
			$main_template->has_account = false;
		}

		$main_template->contents_template = $this->page_template;
	}

	function main() {

		$this->page_template = new Template();

		$status = $this->generate_page();
		$this->setup_site_template();

		return $status;
	}

	abstract protected function generate_page();

	protected function do_post() {}
	protected function on_instance() {}

	protected function get_page_template() {
		return $this->page_template;
	}
	protected function set_page_template() {
		return $this->page_template;
	}

	protected function get_account_session() {
		return $this->account_session;
	}

}
