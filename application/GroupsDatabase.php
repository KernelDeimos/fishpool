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

	/**
	 * Creates an array of Group objects representing all
	 * of the groups a particular user owns
	 *
	 * @param account_id ID of the user
	 * @return User object, or false if no user was found
	 */
	function get_groups_by_owner($account_id) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "SELECT * FROM group WHERE owner = :account_id";
		$statement = $con->prepare($sql);

		// Bind values for profile
		$statement->bindValue("account_id", $account_id, PDO::PARAM_INT);

		// Execute the statement
		$statement->execute();

		$results = array();

		// Check if row exists
		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
	 		// Create user object
	 		$group = new Group($row);
	 		$results[] = $group;
	 	}

	 	return $results;
	}
}