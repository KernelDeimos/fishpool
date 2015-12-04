@echo off

C:\xampp\mysql\bin\mysql -u root -p < accounts_table.sql

C:\xampp\mysql\bin\mysql -u root -p < file_tables.sql

C:\xampp\mysql\bin\mysql -u root -p < site_tables.sql
C:\xampp\mysql\bin\mysql -u root -p < permissions_tables.sql
