<?php

namespace Application;

use PDO;
use PDOException;

/**
 * Acts a sa factory for Group objects and communicates
 * information about new groups to the database.
 */
class ProjectsDatabase {

	const NEW_PROJECT_OKAY = 1;
	const NEW_PROJECT_INTERNAL_ERROR = 2;
	const NEW_PROJECT_INVALID_NAME = 3;

	const NAME_MIN_LENGTH = 2;
	const NAME_MAX_LENGTH = 40;

	private $connection;
	private $last_exception;
	private $last_inserted; 
	
	function __construct($connection) {
		$this->connection = $connection;
	}

	/**
	 * Adds information for a new group as a new entry
	 * in the groups table.
	 *
	 * @param owner_id integer id of the owner of the group
	 * @param PROJECT_name a sanitized name for the group
	 */
	function add_new_project($group_id, $root_folder_id, $project_name) {

		// Ensure that group name is valid
		{
			$test = preg_match('/^[\p{L}\p{N}\'\.\s]{'
				.ProjectsDatabase::NAME_MIN_LENGTH.','.ProjectsDatabase::NAME_MAX_LENGTH
				.'}$/u',
				$project_name
			);

			if ($test === 0) {
				return ProjectsDatabase::NEW_PROJECT_INVALID_NAME;
			}
			else if ($test === false) {
				return ProjectsDatabase::NEW_PROJECT_INTERNAL_ERROR;
			}
		}

		// Variable containing SQL statement		
		$con = $this->connection->get_pdo_connection();
		$sql = "INSERT INTO projects (project_group,name,date_created) VALUES (:group_id, :name, now())";
		
		// Create PDO Prepared Statement
		$stmt = $con->prepare($sql);
		
		// Bind variables to statement
		$stmt->bindValue("group_id", $group_id, PDO::PARAM_INT);
		$stmt->bindValue("name", $project_name, PDO::PARAM_STR);
		
		try {
			// Execute statement
			$stmt->execute();
			$this->last_inserted = $con->lastInsertId();

		} catch (PDOException $e) {
			$this->last_exception = $e;
			return ProjectsDatabase::NEW_PROJECT_INTERNAL_ERROR;
		}

		return ProjectsDatabase::NEW_PROJECT_OKAY;
	}

	/**
	 * Creates an array of Group objects representing all
	 * of the groups a particular user owns
	 *
	 * @param account_id ID of the user
	 * @return User object, or false if no user was found
	 */
	function get_projects_by_group($group_id) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "SELECT * FROM projects WHERE project_group=:group_id";
		$statement = $con->prepare($sql);

		// Bind values for profile
		$statement->bindValue("group_id", $group_id, PDO::PARAM_INT);

		// Execute the statement
		$statement->execute();

		$results = array();

		// Check if row exists
		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
	 		// Create user object
	 		$project = new Project($row);
	 		$results[] = $project;
	 	}

	 	return $results;
	}

	function get_last_inserted() {
		return $this->last_inserted;
	}

	function get_last_exception_message() {
		return $this->last_exception->getMessage();
	}
}