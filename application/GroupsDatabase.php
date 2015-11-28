<?php

namespace Application;

/**
 * Acts a sa factory for Group objects and communicates
 * information about new groups to the database.
 */
class GroupsDatabase {
	$connection;

	function __construct($connection) {
		$this->connection = $connection;
	}

	/**
	 * Adds information for a new group as a new entry
	 * in the groups table.
	 *
	 * @param owner_id integer id of the owner of the group
	 * @param group_name a sanitized name for the group
	 */
	function add_new_group($owner_id, $group_name) {
		//
	}
}