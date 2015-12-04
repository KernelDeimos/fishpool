#!/bin/bash

mysql -u root -p < accounts_table.sql

mysql -u root -p < file_tables.sql

mysql -u root -p < site_tables.sql
mysql -u root -p < permissions_tables.sql
