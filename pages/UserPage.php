<?php

namespace Pages;
use \Framework\ContentPage;
use \Application\DatabaseConnection;
use \Application\UsersDatabase;
use \Application\GroupsDatabase;
use \Application\AccountSession;
use \Application\User;
use PDOException;

class UserPage extends ContentPage {

	function error_response($main_template, $problem) {
		$error_template = new \Framework\Template();
		$error_template->set_template_file(SITE_PATH."/templates/simple_message.template.php");
		$error_template->title = "Oops!";
		$error_template->message = $problem;
		
		$main_template->contents_template = $error_template;
	}
	function do_post($users_database, $pageID){
		if(isset($_POST['edit_info'])) {					
			$users_database->set_bio($pageID, $_POST['bio']);
			$users_database->set_facebook($pageID, $_POST['facebook']);
			$users_database->set_twitter($pageID, $_POST['twitter']);
			$users_database->set_linkedin($pageID, $_POST['linkedin']);
			$users_database->set_email($pageID, $_POST['email']);
		}
	}
	
	function main($main_template) {
		
		$main_template->set_template_file(SITE_PATH."/templates/full.template.php");		
		$account_session = new AccountSession(null);

		$user_template = new \Framework\Template();
		$user_template->set_template_file(SITE_PATH."/templates/user.template.php");
		
		try {
			$database_connection = \Application\DatabaseConnection::create_from_ini(SITE_PATH.'/config/database.ini');
		} catch (PDOException $e) {
			$this->error_response($main_template, "The following internal error occured: ".$e->getMessage());
			return ContentPage::PAGE_OKAY;
		}

		// Get PageID from page request
		$pageID = $this->request->get_parameter(0);
		$pageID = intval($pageID);
		
		
		// Instantiate needed data managers
		$users_database = new UsersDatabase($database_connection);
		$groups_database = new GroupsDatabase($database_connection);
		
		if ($_SERVER["REQUEST_METHOD"] === "POST"){
			$this->do_post($users_database, $pageID); 
		}
		// Get the page user
		$page_user = $users_database->get_user_by_id($pageID);
		// Check for case that user doesn't exist
		if ($page_user === false) {
			$this->error_response($main_template, "The user you're looking for does not exist :/");
			return ContentPage::PAGE_OKAY;
		}
		
		// Set values of user template
		$user_template->page_id = $pageID;
		$user_template->user_name = $page_user->get_username();
		$user_template->facebook = $page_user->get_facebook();
		$user_template->twitter = $page_user->get_twitter();
		$user_template->linkedin = $page_user->get_linkedin();
		$user_template->email = $page_user->get_email();
		$user_template->bio = $page_user->get_bio();
		// Attempt to add groups to template
		try {
			$user_template->groups = $groups_database->get_groups_by_owner($pageID);
		} catch (PDOException $e) {
			$user_template->groups_fetch_error = $e->getMessage();
		}
		
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