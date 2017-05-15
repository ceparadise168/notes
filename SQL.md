mysql> CREATE TABLE msboard.users(id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY)ENGINE = InnoDB;
ERROR 1049 (42000): Unknown database 'msboard'
mysql> CREATE TABLE msgboard.users(id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY)ENGINE = InnoDB;
Query OK, 0 rows affected (0.02 sec)

mysql> ALTER TABLE msboard.users ADD user_name VARCHAR(25) NOT NULL;
ERROR 1146 (42S02): Table 'msboard.users' doesn't exist
mysql> ALTER TABLE msgboard.users ADD user_name VARCHAR(25) NOT NULL;
Query OK, 0 rows affected (0.05 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> ALTER TABLE msgboard.users ADD user_msg VARCHAR(128) NOT NULL;
Query OK, 0 rows affected (0.03 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> USE msgboard;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
mysql> 
