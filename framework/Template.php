<?php

class Template {
	private $vars = array();
	private $templateFile = '';

	function __set($index, $value) {
		$this->vars[$index] = $value;
	}
	function set_template_file($templateFile) {
		$this->templateFile = $templateFile;
	}
	function run() {
		$this->load_template_file($this->templateFile);
	}

	private function load_template_file($file) {
		foreach ($this->vars as $key => $value) $$key = $value;
		include($file);
	}
}
