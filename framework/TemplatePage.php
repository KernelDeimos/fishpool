<?php

namespace Framework;

/**
 * This class represents any response that is designed to
 * send HTML content to the user's browser.
 *
 * This is an improved verison of the ContentPage class,
 * which now uses $template as an instance variable.
 */
abstract class TemplatePage extends Page {
	const PAGE_OKAY = 0;
	const PAGE_REDIRECT = 1;

	private $template;

	abstract protected function main();

	function run() {
		// Instantiate the template variable
		$this->template = new Template();

		// Run the page's main method
		$status = $this->main();

		switch ($status) {
			case ContentPage::PAGE_OKAY:
				$this->template->run();
				break;
			case ContentPage::PAGE_REDIRECT:
				// do nothing
				break;
			default:
				// do nothing (for now)
				break;
		}
	}

	protected function get_template() {
		return $this->template;
	}
}
