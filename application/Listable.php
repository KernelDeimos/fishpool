<?php

namespace Application;

/**
 * Interface for items that can be listed in a directory
 * structure, such as files and folders.
 */

interface Listable {
	public function get_name();
	public function get_type();
	public function get_access_uri();
}
