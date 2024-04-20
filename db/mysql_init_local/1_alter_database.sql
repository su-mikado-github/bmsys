CREATE USER IF NOT EXISTS root@'172.24.%' IDENTIFIED WITH mysql_native_password BY 'si3NCtGs9nLX';
CREATE USER IF NOT EXISTS bmsys_db_user@'172.24.%' IDENTIFIED WITH mysql_native_password BY 'P@sSw0rd';

GRANT ALL ON *.* TO root@'172.24.%';
GRANT ALL ON bmsys_db.* TO bmsys_db_user@'172.24.%';

FLUSH PRIVILEGES;

