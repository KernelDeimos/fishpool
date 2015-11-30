<?php
namespace Application;
use PDO;

class DatabaseConnection {
	private $connection;

	private $host;
	private $schema;

	private $connectionPDO;

	function __construct($host, $schema) {
		// Set instance variables by parameters
		$this->host = $host;
		$this->schema = $schema;
		// Initialize object pointers
		$connectionPDO = null;
	}

	function connect_with_pdo($user, $pass) {
		// Generate database connection's data source name
		$dbDsn = "mysql:host=".$this->host.";dbname=".$this->schema;

		// Create a new PDO connection object
		$con = new PDO( $dbDsn, $user, $pass );
		// Tell PDO object to throw exceptions on error
		$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		// Store the PDO connection object in instance
		$this->connectionPDO = $con;
	}

	function get_pdo_connection() {
		return $this->connectionPDO;
	}

	static function create_development_connection() {
		$dbcon = new DatabaseConnection('localhost', 'FishpoolDB');
		$dbcon->connect_with_pdo('root', '');
		return $dbcon;
	}
}
