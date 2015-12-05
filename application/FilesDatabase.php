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

		// Ensure that folder name is valid
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

	function add_file_to_folder($folder_id, $filename, $contents) {

		// Ensure that file name is valid
		{
			$test = preg_match('/^[a-zA-Z0-9_\.\s-]{'
				.FilesDatabase::NAME_MIN_LENGTH.','.FilesDatabase::NAME_MAX_LENGTH
				.'}$/u',
				$filename
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
		$sql = "INSERT INTO files (folder,filename,contents,date_added,date_modified)
		VALUES (:folder_id, :filename, :contents, now(), now())";
		
		// Create PDO Prepared Statement
		$stmt = $con->prepare($sql);
		
		// Bind variables to statement
		$stmt->bindValue("folder_id", $folder_id, PDO::PARAM_INT);
		$stmt->bindValue("filename", $filename,   PDO::PARAM_STR);
		$stmt->bindValue("contents", $contents,   PDO::PARAM_STR);
		
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

	function get_folders_by_parent($parent_id) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "SELECT * FROM folders WHERE parent=:parent_id";
		$statement = $con->prepare($sql);

		// Bind parent folder id
		$statement->bindValue("parent_id", $parent_id, PDO::PARAM_INT);

		// Execute the statement
		$statement->execute();

		$results = array();

		// Check if row exists
		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
	 		// Create folder object
	 		$folder = new Folder($row);
	 		$results[] = $folder;
	 	}

	 	return $results;
	}

	function get_files_by_folder($folder_id) {
		// Obtain a connection
		$con = $this->connection->get_pdo_connection();

		// Prepare insert statement
		$sql = "SELECT * FROM files WHERE folder=:folder_id";
		$statement = $con->prepare($sql);

		// Bind parent folder id
		$statement->bindValue("folder_id", $folder_id, PDO::PARAM_INT);

		// Execute the statement
		$statement->execute();

		$results = array();

		// Check if row exists
		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) ) {
	 		// Create file object
	 		$file = new File($row);
	 		$results[] = $file;
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