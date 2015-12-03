<?php

namespace Application;

use PDO;
use PDOException;

/**
 * Acts a sa factory for Group objects and communicates
 * information about new groups to the database.
 */
class GroupsDatabase {

	const NEW_GROUP_OKAY = 1;
	const NEW_GROUP_INTERNAL_ERROR = 2;
	const NEW_GROUP_INVALID_NAME = 3;

	const NAME_MIN_LENGTH = 2;
	const NAME_MAX_LENGTH = 40;

	private $connection;
	private $last_inserted; 
	
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

		// Ensure that group name is valid
		{
			$test = preg_match('/^[\p{L}\p{N}\'\.\s]{'
				.GroupsDatabase::NAME_MIN_LENGTH.','.GroupsDatabase::NAME_MAX_LENGTH
				.'}$/u',
				$group_name
			);

			if ($test === 0) {
				return GroupsDatabase::NEW_GROUP_INVALID_NAME;
			}
			else if ($test === false) {
				return GroupsDatabase::NEW_GROUP_INTERNAL_ERROR;
			}
		}

		// Variable containing SQL statement		
		$con = $this->connection->get_pdo_connection();
		$sql = "INSERT INTO groups (owner,name,date_created) VALUES (:owner, :name, now())";
		
		// Create PDO Prepared Statement
		$stmt = $con->prepare($sql);
		
		// Bind variables to statement
		$stmt->bindValue("owner", $owner_id, PDO::PARAM_INT);
		$stmt->bindValue("name", $group_name, PDO::PARAM_STR);
		
		try {
			// Execute statement
			$stmt->execute();
			$this->last_inserted = $con->lastInsertId();

		} catch (PDOException $e) {
			$this->last_exception = $e->getMessage();
			return GroupsDatabase::NEW_GROUP_INTERNAL_ERROR;
		}

		return GroupsDatabase::NEW_GROUP_OKAY;
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
		$sql = "SELECT * FROM groups WHERE owner=:account_id";
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

	function get_last_inserted() {
		return $this->last_inserted;
	}
}