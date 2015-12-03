<?php

namespace Pages;
use \Framework\ContentPage;

use \Application\DatabaseConnection;
use \Application\UsersDatabase;
use \Application\AccountSession;

use PDOException;

class UserPage extends ContentPage {

	function error_response($main_template, $problem) {
		$error_template = new \Framework\Template();
		$error_template->set_template_file(SITE_PATH."/templates/simple_message.template.php");
		$error_template->title = "Oops!";
		$error_template->message = $problem;
		
		$main_template->contents_template = $error_template;
	}

	function main($main_template) {
		
		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");		
		$account_session = new AccountSession(null);

		$user_template = new \Framework\Template();
		$user_template->set_template_file(SITE_PATH."/templates/user.template.php");
		
		try {
			$database_connection = \Application\DatabaseConnection::create_from_ini(SITE_PATH.'/config/database.ini');
		} catch (PDOException $e) {
			$this->error_response($main_template, "The following internal error occured: ".$e->getMessage);
			return ContentPage::PAGE_OKAY;
		}

		// Get PageID from page request
		$pageID = $this->request->get_parameter(0);
		$pageID = intval($pageID);

		$users_database = new UsersDatabase($database_connection);
		$page_user = $users_database->get_user_by_id($pageID);

		// Check for case that user doesn't exist
		if ($page_user === false) {
			$this->error_response($main_template, "The user you're looking for does not exist :/");
			return ContentPage::PAGE_OKAY;
		}
		
		$user_template->page_id = $pageID;
		$user_template->user_name = $page_user->get_username();		
		
		if ($account_session->check_login()) {
			$user_template->login = true;
			// compare loged in userID to userID of page 
			if ($account_session->get_account_id() == $pageID){
				$user_template->is_own_page = true;				
			}
			else{
				$user_template->is_own_page = false;	
			}
		}

		$main_template->contents_template = $user_template;
		return ContentPage::PAGE_OKAY;
	}
}