<?php

namespace Pages;
use \Application\SitePage;

use \Application\DatabaseConnection;
use \Application\UsersDatabase;
use \Application\GroupsDatabase;
use \Application\ProjectsDatabase;
use \Application\AccountSession;

use PDOException;

class GroupPage extends SitePage {

	function error_response($problem) {
		$error_template = new \Framework\Template();
		$error_template->set_template_file(SITE_PATH."/templates/simple_message.template.php");
		$error_template->title = "Oops!";
		$error_template->message = $problem;
		
		$this->set_page_template($error_template);
	}

	function generate_page() {

		// Get PageID from page request
		$pageID = $this->request->get_parameter(0);
		$pageID = intval($pageID);

		$group_template = $this->get_page_template();
		$group_template->set_template_file(SITE_PATH."/templates/group.template.php");

		// Instantiate AccountSession without database
		$account_session = new AccountSession(null);
		
		// Attempt database connection
		try {
			$database_connection = \Application\DatabaseConnection::create_from_ini(SITE_PATH.'/config/database.ini');
		} catch (PDOException $e) {
			$this->error_response("The following internal error occured: ".$e->getMessage);
			return SitePage::PAGE_OKAY;
		}

		// Instantiate needed data managers
		$users_database = new UsersDatabase($database_connection);
		$groups_database = new GroupsDatabase($database_connection);
		$projects_database = new ProjectsDatabase($database_connection);

		// Get the page group
		try {

			$page_group = $groups_database->get_group_by_id($pageID);
			// Check for case that group doesn't exist
			if ($page_group === false) {
				$this->error_response("The group you're looking for does not exist :/");
				return SitePage::PAGE_OKAY;
			}

			// Get a list of group projects
			$group_projects = $projects_database->get_projects_by_group($pageID);

		} catch (PDOException $e) {
			$this->error_response("The following internal error occured: ".$e->getMessage());
			return SitePage::PAGE_OKAY;
		}

		// Set values of group template
		$group_template->group_id = $pageID;
		$group_template->group_name = $page_group->get_name();
		$group_template->group_projects = $group_projects;
		
		if ($account_session->check_login()) {
			$group_template->login = true;
			// compare loged in userID to userID of page 
			if ($account_session->get_account_id() == $page_group->get_owner()){
				$group_template->is_own_group = true;				
			}
			else{
				$group_template->is_own_group = false;	
			}
		}

		return SitePage::PAGE_OKAY;
	}
}