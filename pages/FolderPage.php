<?php

namespace Pages;
use \Application\SitePage;
use \Application\AccountSession;
use \Application\FilesDatabase;

use \Application\File;
use \Application\Folder;

class FolderPage extends SitePage {

	private $files_database;

	function error_response($problem) {
		$error_template = new \Framework\Template();
		$error_template->set_template_file(SITE_PATH."/templates/simple_message.template.php");
		$error_template->title = "Oops!";
		$error_template->message = $problem;
		
		$this->set_page_template($error_template);
	}
	function generate_test_items(&$folders, &$files) {
		for ($i=0; $i < 10; $i++) {
			$folders[] = new Folder(array(
				'name' => "Test Folder #".$i,
			));
			$files[] = new File(array(
				'name' => "Test File #".$i,
			));
		}
	}

	function do_post() {

		// Obtain number a the end of the URL
		$folder_id = $this->request->get_parameter(0);
		$folder_id = intval($folder_id);

		$template = $this->get_page_template();
		// Instantiate class for communicating with files tables
		$files_db = $this->files_database;

		// Check if the user requested to create a folder
		if (isset($_POST['folder'])) {
			try {
				// Attempt to create a new folder
				$status = $files_db->create_new_folder($folder_id, $_POST['name']);

				// Return response corresponding to status
				if ($status === FilesDatabase::NEW_ITEM_OKAY) {
					// Return okay message since upload succeeded
					$template->status = "okay";
					$template->message = "Successfully created folder!";
				}
				else if ($status === FilesDatabase::NEW_ITEM_INVALID_NAME) {
					$template->status = "error";
					$template->message = "Valid folder names must contain a-zA-z0-9_.- and spaces.";
				} else {
					$template->status = "error";
					$template->message = "An unknown error occured created the new folder";
				}
			} catch (PDOException $e) {
				$template->status = "error";
				$template->message = "An unknown error occured created the new folder";
			}
		}

		// Check if the user requested to upload a file
		else if (isset($_POST['file'])) {

			print_r($_FILES);

			// Verify that file was sent, or set error message
			if (!isset($_FILES['codefile']['error'])) {
				$template->status = "error";
				$template->message = "Error: No file was sent!";
				return;
			}

			$file_status = $_FILES['codefile']['error'];

			// Verify that status is okay, or set error message
			if ($file_status !== UPLOAD_ERR_OK) {
				$template->status = "error";
				switch ($_FILES['codefile']['error']) {
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						$template->message = "The file you attempted to upload was too large!";
						break;
					
					default:
						$template->message = "An unknown error occured uploading the file";
						break;
				}
				return;
			}

			// Open and read file
			$tmp_name = $_FILES['codefile']['tmp_name'];
			$fp = fopen($tmp_name);
			$contents = fread($fp, filesize($tmp_name));

			// Attempt database operation
			try {
				// Attempt to add a database record for this file
				$status = $files_db->add_file_to_folder($folder_id, $_POST['name'], $contents);

				// Return response corresponding to status
				if ($status === FilesDatabase::NEW_ITEM_OKAY) {
					$template->status = "okay";
					$template->message = "Successfully created file!";
				}
				else if ($status === FilesDatabase::NEW_ITEM_INVALID_NAME) {
					$template->status = "error";
					$template->message = "Valid file names must contain a-zA-z0-9_.- and spaces.";
				} else {
					$template->status = "error";
					$template->message = "An unknown error occured created the new file";
				}
			} catch (PDOException $e) {
				$template->status = "error";
				$template->message = "An unknown error occured created the new file";
			}
		}
	}

	function generate_page() {

		// Obtain number at the end of the URL
		$pageID = $this->request->get_parameter(0);
		$pageID = intval($pageID);

		try {
			$database_connection = \Application\DatabaseConnection::create_from_ini(SITE_PATH.'/config/database.ini');
		} catch (PDOException $e) {
			$this->error_response("The following internal error occured: ".$e->getMessage);
			return SitePage::PAGE_OKAY;
		}

		// Instantiate class for communicating with files tables
		$files_database = new FilesDatabase($database_connection);

		// Set files database as instance variable
		$this->files_database = $files_database;

		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			$this->do_post();
		}

		// Get folder from database
		$folder = $files_database->get_folder_by_id($pageID);

		// Fetch folders and files in the requested folder
		$folders_list = $files_database->get_folders_by_parent($pageID);
		$files_list = $files_database->get_files_by_folder($pageID);

		$this->generate_test_items($folders_list, $files_list);

		// Setup the folder template
		$folder_template = $this->get_page_template();
		$folder_template->set_template_file(SITE_PATH."/templates/folder.template.php");

		// Set meta data for folder contents
		$folder_template->folder_name = "Test Folder";
		$folder_template->folder_id = $pageID;

		// Set parent directory if applicable
		$parent = $folder->get_parent_id();
		if ($parent != null) {
			$folder_template->parent_uri = WEB_PATH.'/folder/'.$parent;
		}

		// Add folders and files to folder page
		$folder_template->items = array_merge($folders_list, $files_list);

		return SitePage::PAGE_OKAY;
	}
}
