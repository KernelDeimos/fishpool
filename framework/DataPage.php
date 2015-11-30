<?php

namespace Framework;

/**
 * This class represents any response that is designed to
 * send JSON content to the user's browser.
 */
abstract class DataPage extends Page {

	abstract protected function main($template);

	function run() {
		$data = $this->main($template);
		ob_clean();
		echo json_encode($data);
	}
}
