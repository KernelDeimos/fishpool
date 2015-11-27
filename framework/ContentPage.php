<?php

namespace Framework;

/**
 * This class represents any response that is designed to
 * send HTML content to the user's browser.
 */
abstract class ContentPage extends Page {
	const PAGE_OKAY = 0;
	const PAGE_REDIRECT = 1;

	abstract protected function main(&$template);

	function run() {
		$template = new Template();
		$status = $this->main($template);

		switch ($status) {
			case ContentPage::PAGE_OKAY:
				$template->run();
				break;
			case ContentPage::PAGE_REDIRECT:
				// do nothing
				break;
			default:
				// do nothing (for now)
				break;
		}
	}
}
