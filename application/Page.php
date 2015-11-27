<?php

abstract class Page {
	abstract protected function process_request();
	abstract protected function generate_response();

	function run_page($request) {
		$this->process_request($request);
		$this->generate_header();
		$this->generate_response();
	}
}