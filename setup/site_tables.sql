-- 2015-11-27
use FishpoolDB;

CREATE TABLE users (
	account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	name  VARCHAR(40),

	FOREIGN KEY (id) REFERENCES accounts(account_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE groups (
	group_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	owner MEDIUMINT NOT NULL,
	name  VARCHAR(40),
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (owner) REFERENCES users(account_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE projects (
	project_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	group MEDIUMINT NOT NULL,
	name  VARCHAR(40),
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (group) REFERENCES groups(group_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE files (
	file_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	project MEDIUMINT NOT NULL,
	-- maximum filename length on most OSs is 255
	filename  VARCHAR(255),
	-- maximum mime length (by spec) is 255
	mime      VARCHAR(255),
	date_added datetime NOT NULL default '0000-00-00 00:00:00',
	date_modified datetime NOT NULL default '0000-00-00 00:00:00',

	contents TEXT,

	FOREIGN KEY (project) REFERENCES projects(project_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
