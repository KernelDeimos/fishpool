-- 2015-11-28
use FishpoolDB;

CREATE TABLE IF NOT EXISTS folders (
	folder_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	parent MEDIUMINT NOT NULL,
	-- maximum filename length on most OSs is 255
	name  VARCHAR(255),

	date_added datetime NOT NULL default '0000-00-00 00:00:00',

	FOREIGN KEY (project) REFERENCES projects(project_id),
	FOREIGN KEY (parent)  REFERENCES folders(folder_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS files (
	file_id MEDIUMINT NOT NULL AUTO_INCREMENT,
	folder MEDIUMINT NOT NULL,
	-- maximum filename length on most OSs is 255
	filename  VARCHAR(255),
	-- maximum mime length (by spec) is 255
	mime      VARCHAR(255),
	date_added datetime    NOT NULL default '0000-00-00 00:00:00',
	date_modified datetime NOT NULL default '0000-00-00 00:00:00',

	contents TEXT,

	FOREIGN KEY (folder) REFERENCES folders(folder_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
