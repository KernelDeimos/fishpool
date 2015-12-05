<?php

namespace Application;

class Project {

	private $data;

	function __construct($data) {
		$this->data = $data;
	}
	function get_name() {
		return $this->data['name'];
	}
	function get_folder() {
		return $this->data['project_folder'];
	}

}
