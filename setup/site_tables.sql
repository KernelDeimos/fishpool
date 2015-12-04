-- 2015-11-27
use FishpoolDB;

CREATE TABLE IF NOT EXISTS users (
	account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	name  VARCHAR(40),

	FOREIGN KEY (account_id) REFERENCES accounts(account_id),
	PRIMARY KEY (account_id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS groups (
	group_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	owner MEDIUMINT NOT NULL,
	name  VARCHAR(40),
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (owner) REFERENCES users(account_id),
	PRIMARY KEY (group_id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS projects (
	project_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	project_group MEDIUMINT NOT NULL,
	project_folder MEDIUMINT NOT NULL UNIQUE,
	name  VARCHAR(40),
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (project_group) REFERENCES groups(group_id),
	FOREIGN KEY (project_folder) REFERENCES folders(folder_id),
	PRIMARY KEY (project_id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
