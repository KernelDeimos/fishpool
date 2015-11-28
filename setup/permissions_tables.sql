-- 2015-11-27
use FishpoolDB;

CREATE TABLE groups_permissions (
	group_id   MEDIUMINT NOT NULL AUTO_INCREMENT,
	account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	permission_flags INT UNSIGNED,
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (group_id)   REFERENCES groups(group_id),
	FOREIGN KEY (account_id) REFERENCES users(account_id),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE projects_permissions (
	project_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	account_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	permission_flags INT UNSIGNED,
	date_created datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (project_id) REFERENCES projects(project_id),
	FOREIGN KEY (account_id) REFERENCES users(account_id),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
