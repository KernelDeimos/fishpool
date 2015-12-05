<?php

namespace Application;

class Folder {

	private $data;

	function __construct($data) {
		$this->data = $data;
	}
	function get_name() {
		return $this->data['name'];
	}

}
