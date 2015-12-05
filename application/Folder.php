<?php

namespace Application;
use \Application\Listable;

class Folder implements Listable {

	private $data;

	function __construct($data) {
		$this->data = $data;
	}
	function get_name() {
		return $this->data['name'];
	}
	function get_type() {
		return "folder";
	}
	function get_access_uri() {
		return WEB_PATH.'/folder/'.$this->data['folder_id'];
	}
	function get_parent_id() {
		return $this->data['parent'];
	}

}
