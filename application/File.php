<?php

namespace Application;

class File {

	private $data;

	function __construct($data) {
		$this->data = $data;
	}
	function get_name() {
		return $this->data['name'];
	}
	function get_type() {
		return "file";
	}

}
