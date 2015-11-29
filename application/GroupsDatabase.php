<?php

namespace Application;

/**
 * Acts a sa factory for Group objects and communicates
 * information about new groups to the database.
 */
class GroupsDatabase {
	private $connection;
	private $lastInsertId; 
	
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
		// Variable containing SQL statement		
		$con = $this->connection->get_pdo_connection();
		$sql = "INSERT INTO groups (owner,name,date_created) VALUES (:owner, :name, now())";
		
		// Create PDO Prepared Statement
		$stmt = $con->prepare($sql);
		
		// Bind variables to statement
		$stmt->bindValue("owner", $owner_id, PDO::PARAM_INT);
		$stmt->bindValue("name", $group_name, PDO::PARAM_STR);
		
		// Execute statement
		$stmt->execute();
		$goupID = $con->lastInsertId();		
	}
}