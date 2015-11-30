<?php

namespace Framework;

/**
 * This class represents any response that is designed to
 * send JSON content to the user's browser.
 */
abstract class DataPage extends Page {

	abstract protected function main();

	function run() {
		$data = $this->main();
		if (count($data) < 1) {
			$data = array('status' => "internal_error");
		}
		//ob_clean();
		echo json_encode($data);
	}
}
