<?php

namespace Pages;
use \Framework\ContentPage;

class TemplateTestPage extends ContentPage {
	function main($template) {
		$template->set_template_file(SITE_PATH."/templates/full.template.php");
		return ContentPage::PAGE_OKAY;
	}
}
