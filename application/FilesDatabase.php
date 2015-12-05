<?php

namespace Application;

use PDO;
use PDOException;

/**
 * Acts a sa factory for Group objects and communicates
 * information about new groups to the database.
 */
class FilesDatabase {

	const NEW_ITEM_OKAY = 1;
	const NEW_ITEM_INTERNAL_ERROR = 2;
	const NEW_ITEM_INVALID_NAME = 3;

	const NAME_MIN_LENGTH = 2;
	const NAME_MAX_LENGTH = 255;

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
	function create_new_folder($parent_id, $folder_name) {

		// Ensure that group name is valid
		{
			$test = preg_match('/^[a-zA-Z0-9_\.\s-]{'
				.FilesDatabase::NAME_MIN_LENGTH.','.FilesDatabase::NAME_MAX_LENGTH
				.'}$/u',
				$folder_name
			);

			if ($test === 0) {
				return FilesDatabase::NEW_ITEM_INVALID_NAME;
			}
			else if ($test === false) {
				return FilesDatabase::NEW_ITEM_INTERNAL_ERROR;
			}
		}

		// Variable containing SQL statement		
		$con = $this->connection->get_pdo_connection();
		$sql = "INSERT INTO folders (parent,name,date_added) VALUES (:parent_id, :name, now())";
		
		// Create PDO Prepared Statement
		$stmt = $con->prepare($sql);
		
		// Bind variables to statement
		$stmt->bindValue("parent_id", $parent_id,   PDO::PARAM_INT);
		$stmt->bindValue("name",      $folder_name, PDO::PARAM_STR);
		
		try {
			// Execute statement
			$stmt->execute();
			$this->last_inserted = $con->lastInsertId();

		} catch (PDOException $e) {
			$this->last_exception = $e;
			return FilesDatabase::NEW_ITEM_INTERNAL_ERROR;
		}

		return FilesDatabase::NEW_ITEM_OKAY;
	}

	function get_last_inserted() {
		return $this->last_inserted;
	}

	function get_last_exception_message() {
		return $this->last_exception->getMessage();
	}
}