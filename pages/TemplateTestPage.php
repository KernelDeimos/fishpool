<?php

namespace Pages;
use \Framework\ContentPage;

class TemplateTestPage extends ContentPage {
	function main($template) {
		$contents = new \Framework\Template();
		$contents->set_template_file(SITE_PATH."/templates/simple_message.template.php");
		$template->set_template_file(SITE_PATH."/templates/full.template.php");
		$template->contents_template = $contents;
		$contents->title = $this->request->get_page();
		return ContentPage::PAGE_OKAY;
	}
}
