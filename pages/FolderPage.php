<?php

namespace Pages;
use \Application\SitePage;
use \Application\AccountSession;
use \Application\FilesDatabase;

use \Application\File;
use \Application\Folder;

class FolderPage extends SitePage {

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
			$files[] = new Folder(array(
				'name' => "Test File #".$i,
			));
		}
	}

	function generate_page() {

		$pageID = $this->request->get_parameter(0);
		$pageID = intval($pageID);

		try {
			$database_connection = \Application\DatabaseConnection::create_from_ini(SITE_PATH.'/config/database.ini');
		} catch (PDOException $e) {
			$this->error_response("The following internal error occured: ".$e->getMessage);
			return SitePage::PAGE_OKAY;
		}

		$files_database = new FilesDatabase($database_connection);
		$folders_list = $files_database->get_folders_by_parent($pageID);
		$files_list = $files_database->get_files_by_folder($pageID);

		$this->generate_test_items($folders_list, $files_list);

		$folder_template = $this->get_page_template();
		$folder_template->set_template_file(SITE_PATH."/templates/folder.template.php");

		$folder_template->folder_name = "Test Folder";
		$folder_template->folder_id = $pageID;;
		$folder_template->items = array_merge($folders_list, $files_list);

		return SitePage::PAGE_OKAY;
	}
}