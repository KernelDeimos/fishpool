<?php

namespace Application;

class File implements Listable {

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
	function get_access_uri() {
		return WEB_PATH.'/file/'.$this->data['file_id'];
	}

}
